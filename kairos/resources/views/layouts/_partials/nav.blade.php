<nav>

    <ul>
        <li><a href="{{route('psicologos.inicio')}}">Inicio</a></li>
        <li><a href="{{route('pacientes.activos')}}">Pacientes</a></li>
        <li><a href="{{route('psicologos.agenda')}}">Agenda</a></li>
        <li>
            <form action="{{ route('psicologos.logout') }}" method="POST" style="display: block; height: 100%;">
                @csrf
                <button type="submit" class="nav-link-btn">
                    Cerrar Sesión
                </button>
            </form>
        </li>
    </ul>

</nav>