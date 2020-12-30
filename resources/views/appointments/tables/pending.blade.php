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
        @foreach($pendingAppointments as $appointment)
            <tr>
                <th scope="row">
                    {{$appointment->description}}
                </th>
                <td>
                    {{$appointment->specialty->name}}
                </td>

                @if($role == 'patient')
                    <td scope="col">{{$appointment->doctor->name}}</td>
                @elseif($role == 'doctor')
                    <td scope="col">{{$appointment->patient->name}}</td>
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
                    @if($role == 'doctor' || $role == 'admin' )
                        <a class="btn btn-sm btn-primary" title="Ver Cita"
                           href="{{url('/appointments/'.$appointment->id )}}">Ver
                        </a>
                    @endif
                    @if($role == 'doctor' || $role == 'admin' )
                        <form action="{{ url('/appointments/'.$appointment->id.'/confirm') }}"
                              method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Confirmar Cita">
                                <i class="ni ni-check-bold"></i>
                            </button>
                        </form>
                        <a href="{{ url('/appointments/'.$appointment->id.'/cancel') }}"
                           class="btn btn-sm btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Cancelar Cita">
                            <i class="ni ni-fat-delete"></i>
                        </a>
                    @else
                        <form action="{{ url('/appointments/'.$appointment->id.'/cancel') }}"
                              method="POST" class="d-inline-block">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger"
                                    data-toggle="tooltip" data-placement="top"
                                    title="Cancelar Cita">
                                <i class="ni ni-fat-delete"></i>
                            </button>

                        </form>

                    @endif


                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
</div>
<div class="card-body">
    {{$pendingAppointments->links()}}
</div>
