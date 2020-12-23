<h6 class="navbar-heading text-muted">
    @if(auth()->user()->role=='admin')
        Operaciones
    @else
        Men&uacute;
    @endif
</h6>
<ul class="navbar-nav">
    @if(auth()->user()->role=='admin')
        <li class="nav-item">
            <a class="nav-link" href="/home">
                <i class="ni ni-tv-2 text-primary"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/specialties">
                <i class="ni ni-button-play text-blue"></i>Especialidades
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/doctors">
                <i class="ni ni-button-play text-orange"></i>Medicos
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/patients">
                <i class="ni ni-button-play text-yellow"></i>Pacientes
            </a>
        </li>
    @elseif (auth()->user()->role=='doctor')
        <li class="nav-item">
            <a class="nav-link" href="/schedule">
                <i class="ni ni-calendar-grid-58 text-blue"></i>Gestionar horario
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/patients">
                <i class="ni ni-time-alarm text-yellow"></i>Mis pacientes
            </a>
        </li>
    @else {{-- patients --}}
    <li class="nav-item">
        <a class="nav-link" href="/specialties">
            <i class="ni ni-send text-blue"></i>Reservar Citas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/specialties">
            <i class="ni ni-timq text-blue"></i>Mis citas
        </a>
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}"
           onclick="event.preventDefault(); document.getElementById('FormLogout').submit() ">
            <i class="ni ni-key-25 text-info"></i>Cerrar sesion
        </a>
        <form action="{{route('logout')}}" METHOD="POST" style="display: none;" id="FormLogout">
            @csrf
        </form>
    </li>
</ul>
@if(auth()->user()->role=='admin')

    <!-- Divider -->
    <hr class="my-3">
    <!-- Heading -->
    <h6 class="navbar-heading text-muted">Reportes</h6>
    <!-- Navigation -->
    <ul class="navbar-nav mb-md-3">
        <li class="nav-item">
            <a class="nav-link"
               href="#">
                <i class="ni ni-button-play"></i> Frecuencias de Citas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               href="#">
                <i class="ni ni-button-play"></i> Medicos Activos
            </a>
        </li>
    </ul>
@endif
