@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cancelar Citas</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if(session('notification'))
                <div class="alert alert-success" role="alert">
                    {{session('notification')}}
                </div>
            @endif
            @if($role == 'patient')
                <p>Estas a punto de cancelar la cita reservada con el medico
                    {{$appointment->doctor->name }}
                    para el dia : {{ $appointment->schedule_date }}
                    de la especialidad {{$appointment->specialty->name}}
                </p>
            @elseif ($role == 'doctor')
                <p>Estas a punto de cancelar tu cita reservada con el paciente
                    {{$appointment->patient->name }}
                    para el dia : {{ $appointment->schedule_date }}
                    de la especialidad {{$appointment->specialty->name}}
                    en la hora {{$appointment->schedule_time_12}}
                </p>
            @elseif ($role == 'admin')
                <p>Estas a punto de cancelar la cita reservada por el paciente
                    {{$appointment->patient->name }} con el doctor
                    {{$appointment->doctor->name }}
                    para el dia : {{ $appointment->schedule_date }}
                    de la especialidad {{$appointment->specialty->name}}
                    a la hora {{$appointment->schedule_time_12}}
                </p>
            @endif
            <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="justification">Por favor cuentanos el motivo de la cancelacion:</label>
                    <textarea id="justification" name="justification" rows="3" class="form-control" required></textarea>
                </div>
                <button class="btn btn-dribbble" type="submit">Cancelar Cita</button>
                <a class="btn btn-default" href="{{url('/appointments')}}">No quiero cancelar la cita</a>
            </form>
        </div>
    </div>
@endsection
