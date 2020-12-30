@extends('layouts.panel')

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">Cita Numero {{ $appointment->id }}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul>
                <li><strong>Fecha:</strong> {{ $appointment->schedule_date  }} </li>
                <li><strong>Hora:</strong> {{ $appointment->schedule_time_12  }} </li>
                @if($role == 'patient' || $role == 'admin')
                    <li><strong>Medico:</strong> {{ $appointment->doctor->name  }} </li>
                @endif
                @if($role == 'doctor' || $role == 'admin')
                    <li><strong>Paciente:</strong> {{ $appointment->patient->name  }} </li>
                @endif
                <li><strong>Especialidad:</strong> {{ $appointment->specialty->name  }} </li>
                <li><strong>Tipo:</strong> {{ $appointment->type  }} </li>
                <li><strong>Estado:</strong>
                    @if($appointment->status == 'Cancelada')
                        <span class="badge badge-danger">Cancelada</span>
                    @else
                        <span class="badge badge-success">{{ $appointment->status  }}
                    @endif

                </li>
            </ul>
            @if($appointment->status == 'Cancelada')
                <div class="alert-warning">
                    <p>Acerca de la Cancelacion</p>
                    <ul>
                        @if($appointment->cancellation)
                            <li><strong>Motivo de la
                                    Cancelacion:</strong> {{ $appointment->cancellation->justification }}
                            </li>
                            <li><strong>Fecha :</strong> {{ $appointment->cancellation->created_at  }} </li>
                            <li><strong>Cancelado Por:</strong>
                                @if(auth()->id() == $appointment->cancellation->cancelled_by_id)
                                    Tu
                                @else
                                    {{ $appointment->cancellation->cancelled_by->name }}
                                @endif
                            </li>
                            <li><strong>Justificacion :</strong> {{ $appointment->cancellation->justification  }} </li>
                        @else
                            <li>Cita cancelada antes de confirmar</li>
                        @endif
                    </ul>
                </div>
            @endif
            <a href="{{url('/appointments')}}" class="btn btn-dribbble btn-sm">Regresar</a>
        </div>

@endsection
