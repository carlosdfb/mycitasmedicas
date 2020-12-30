<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CancelledAppointment;
use App\Interfaces\ScheduleServiceInterface;
use App\specialty;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Validator;

class AppointmentController extends Controller
{
    public function index()
    {

        $role = auth()->user()->role;
        // admin
        if ($role == 'admin') {
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->paginate(10);
            // doctor
        } elseif ($role == 'doctor') {
            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('doctor_id', auth()->id())
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('doctor_id', auth()->id())
                ->paginate(10);

        } elseif ($role == 'patient') {


            // patient

            $pendingAppointments = Appointment::where('status', 'Reservada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
            $confirmedAppointments = Appointment::where('status', 'Confirmada')
                ->where('patient_id', auth()->id())
                ->paginate(10);
            $oldAppointments = Appointment::whereIn('status', ['Atendida', 'Cancelada'])
                ->where('patient_id', auth()->id())
                ->paginate(10);
        }
        return view('appointments.index', compact('pendingAppointments', 'confirmedAppointments',
            'oldAppointments', 'role'));
    }

    public function show(Appointment $appointment)
    {
        $role = auth()->user()->role;
        return view('appointments.show', compact('appointment', 'role'));
    }

    public function create(ScheduleServiceInterface $scheduleService)
    {

        $specialties = specialty::all();
        $specialtyId = old('specialty_id');
        if ($specialtyId) {
            $specialty = specialty::find($specialtyId);
            $doctors = $specialty->users;
        } else {
            $doctors = collect();
        }

        $date = old('schedule_date');
        $doctorId = old('doctor_id');
        if ($date && $doctorId) {
            $intervals = $scheduleService->getAvailableIntervals($date, $doctorId);
        } else {
            $intervals = null;
        }

        return view('appointments.create', compact('specialties', 'doctors', 'intervals'));
    }

    public function store(Request $request, ScheduleServiceInterface $scheduleService)
    {
        $rules = [
            'description' => 'required',
            'specialty_id' => 'exists:specialties,id',
            'doctor_id' => 'exists:users,id',
            'schedule_time' => 'required',
        ];
        $messages = [
            'schedule_time.required' => 'Por favor seleccione una hora disponible para su cita',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);


        $validator->after(function ($validator) use ($request, $scheduleService) {
            $date = $request->input('schedule_date');
            $doctorId = $request->input('doctor_id');
            $schedule_time = $request->input('schedule_time');
            if ($date && $doctorId && $schedule_time) {
                $start = new Carbon($schedule_time);
            } else {
                return;
            }

            if (!$scheduleService->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add('available_time', 'La hora esta reservada por otro paciente');
            }
        });
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();

        }

        $data = $request->only([
            'description',
            'specialty_id',
            'doctor_id',
            'schedule_date',
            'schedule_time',
            'type'
        ]);
        $data['patient_id'] = auth()->id();

        // convertir la hora en formato tiem
        $carbonTime = Carbon::createFromFormat('g:i A', $data['schedule_time']);
        $data['schedule_time'] = $carbonTime->format('H:i:s');
        Appointment::create($data);

        $notification = 'La cita se ha registrado correctamente';
        return back()->with(compact('notification'));
        // return redirect('/appoiments');
    }

    public function showCancelForm(Appointment $appointment)
    {
        if ($appointment->status == 'Confirmada') {
            $role = auth()->user()->role;
            return view('appointments.cancel', compact('appointment','role'));
        }
        // return redirect('/appointments');
    }

    public function postCancel(Appointment $appointment, Request $request)
    {
        if ($request->has('justification')) {
            $cancellation = new CancelledAppointment();
            $cancellation->justification = $request->input('justification');
            $cancellation->cancelled_by = auth()->id();
            $appointment->cancellation()->save($cancellation);
        }
        $appointment->status = 'Cancelada';
        $appointment->save(); // update la cita

        $notification = 'La cita se ha cancelado correctamente';
        //return back()->with(compact('notification'));
        return redirect('/appointments')->with(compact('notification'));

    }

    public function postConfirm(Appointment $appointment, Request $request)
    {

        $appointment->status = 'Confirmada';
        $appointment->save(); // update la cita

        $notification = 'La cita se ha confirmado correctamente';
        //return back()->with(compact('notification'));
        return redirect('/appointments')->with(compact('notification'));

    }

}
