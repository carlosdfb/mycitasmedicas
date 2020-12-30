<div class="table-responsive">
    <!-- appointments -->
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
        <tr>
            <th scope="col">Descripci&oacute;n</th>
            <th scope="col">Especialidad</th>
            @if($role == 'patient')
                <th scope="col">Medico</th>
            @elseif($role == 'doctor')
                <th scope="col">Paciente</th>
            @endif
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Tipo</th>
            <th scope="col">Opciones</th>

        </tr>
        </thead>
        <tbody>
        @foreach($confirmedAppointments as $appointment)
            <tr>
                <th scope="row">
                    {{$appointment->description}}
                </th>
                <th scope="row">
                    {{$appointment->specialty->name}}
                </th>
                @if($role == 'patient')
                    <td scope="col"> {{$appointment->doctor->name}}</td>
                @elseif($role == 'doctor')
                    <td scope="col"> {{$appointment->patient->name}}</td>
                @endif
                <td>
                    {{$appointment->schedule_date}}
                </td>
                <td>
                    {{$appointment->schedule_time_12}}
                </td>
                <td>
                    {{$appointment->type}}
                </td>
                <td>
                    @if($role == 'admin' || $role == 'doctor')
                        <a class="btn btn-sm btn-primary"  title="Ver Cita"
                           data-toggle="tooltip" data-placement="top"
                           href="{{url('/appointments/'.$appointment->id)}}">Ver
                        </a>
                    @endif
                    <a class="btn btn-sm btn-danger" title="Cancelar Cita"
                       data-toggle="tooltip" data-placement="top"
                       href="{{url('/appointments/'.$appointment->id.'/cancel')}}">Cancelar
                        Cita
                    </a>

                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="card-body">
    {{$confirmedAppointments->links()}}
</div>
