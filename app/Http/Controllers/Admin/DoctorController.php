<?php

namespace App\Http\Controllers\Admin;

use App\specialty;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $doctors = User::doctors()->get();

        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $specialties = specialty::all();
        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'adress' => 'nullable|min:5',
            'phone' => 'min:6',
        ];
        $this->validate($request, $rules);
        $user = User::create($request->only('name', 'email', 'dni', 'adress', 'phone')
            + [
                'role' => 'doctor',
                'password' => bcrypt($request->input('password'))
            ]
        );

        $user->specialties()->attach($request->input('specialties'));
        $notification = 'Doctor creado satisfactoriamente';
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)

    {
        $doctor = User::doctors()->findOrFail($id);
        $specialties = specialty::all();
        $specialty_ids = $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor', 'specialties', 'specialty_ids'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'dni' => 'nullable|digits:8',
            'adress' => 'nullable|min:5',
            'phone' => 'min:6',
        ];
        $this->validate($request, $rules);
        // encontrar al usuari
        $user = User::doctors()->findOrFail($id);
        $doctorName = $user->name;

        // obtenemos la data del formulario
        $data = $request->only('name', 'email', 'dni', 'adress', 'phone');
        $password = $request->input('password');
        if ($password)
            $data['password'] = bcrypt($password);
        $user->fill($data);
        $user->save(); // update la inforacion basica

        $user->specialties()->sync($request->input('specialties'));

        $notification = "Doctor $doctorName actualizado satisfactoriamente";
        return redirect('/doctors')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $doctor
     * @return Response
     * @throws \Exception
     */
    public function destroy(User $doctor)
    {
        $doctorName = $doctor->name;
        $doctor->delete();
        $notification = "Se Elimino el Doctor $doctorName ";
        return redirect('/doctors')->with(compact('notification'));

    }
}
