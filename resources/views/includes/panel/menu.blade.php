<!-- Navigation -->
<h6 class="navbar-heading text-muted">Operaciones</h6>

<ul class="navbar-nav">
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
    <li class="nav-item">
        <a class="nav-link" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('FormLogout').submit() " >
            <i class="ni ni-key-25 text-info"></i>Cerrar sesion
        </a>
        <form action="{{route('logout')}}" METHOD="POST" style="display: none;" id="FormLogout">
            @csrf
        </form>
    </li>
</ul>
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
