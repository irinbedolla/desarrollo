<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @auth
        @role('Super Usuario')
            <a class="nav-link" href="{{ route('usuarios') }}">
                <i class="fas fa-users"></i></i><span class="text-dark">Usuarios</span>
            </a>
            <a class="nav-link" href="{{ route('roles') }}">
                <i class="fas fa-user-shield"></i></i><span class="text-dark">Roles</span>
            </a>
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">Revista</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">SEEER</span>
            </a>
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">Estadisticas</span>
            </a>
        @endrole
    @endauth
    @auth
        @role('Administrador')
            <a class="nav-link" href="{{ route('usuarios') }}">
                <i class="fas fa-users"></i></i><span class="text-dark">Usuarios</span>
            </a>
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Auxiliar')
        <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">SEEER</span>
            </a>
        @endrole
    @endauth
    
    @auth
        @role('Capacitacion Admin')
            <a<a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth

    
    @auth
        @role('Conciliador')
        <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">SEEER</span>
            </a>
        @endrole
    @endauth
    

    @auth
        @role('Notificador')
        <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">SEEER</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Delegado')
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">SEEER</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Estadistica')
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark">Estadisticas</span>
            </a>
        @endrole
    @endauth    
</li>


