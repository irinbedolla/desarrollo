
<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    @auth
        @role('Super Usuario')
            <a class="nav-link" href="{{ route('usuarios') }}">
                <i class="fas fa-users"></i></i><span class="text-dark" onclick="usuarios()">Usuarios</span>
            </a>
            <a class="nav-link" href="{{ route('roles') }}">
                <i class="fas fa-user-shield"></i></i><span class="text-dark" onclick="roles()">Roles</span>
            </a>
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="revista()">Revista</span>
            </a>
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="{{ route('turnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
            <a class="nav-link" href="{{ route('misturnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>
            <a class="nav-link" href="{{ route('turno_estadistica') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a>
            <a class="nav-link" href="{{ route('registro') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Registro</span>
            </a>
        @endrole
    @endauth
    @auth
        @role('Administrador')
        <a class="nav-link" href="{{ route('usuarios') }}">
                <i class="fas fa-users"></i></i><span class="text-dark" onclick="usuarios()">Usuarios</span>
            </a>
            <a class="nav-link" href="{{ route('roles') }}">
                <i class="fas fa-user-shield"></i></i><span class="text-dark" onclick="roles()">Roles</span>
            </a>
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="revista()">Revista</span>
            </a>
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="{{ route('turnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
            <a class="nav-link" href="{{ route('misturnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>
            <a class="nav-link" href="{{ route('turno_estadistica') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Auxiliar')
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="{{ route('misturnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>   
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Conciliador')
        |   <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Notificador')
            <a class="nav-link" href="{{ route('seer') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="{{ route('miscapacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        @endrole
    @endauth
    
    @auth
        @role('Capacitacion Admin')
            <a<a class="nav-link" href="{{ route('capacitaciones') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="{{ route('expedientes') }}">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Delegado')
            <a class="nav-link" href="{{ route('poderes') }}">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="{{ route('turno_estadistica') }}">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a> 
        @endrole
    @endauth

    @auth
        @role('Estadistica')
            <a class="nav-link" href="{{ route('seer.estadistica') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
        @endrole
    @endauth    


    @auth
        @role('Turnos')
            <a class="nav-link" href="{{ route('turnos') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Registro')
            <a class="nav-link" href="{{ route('.0000000') }}">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Registro</span>
            </a>
        @endrole
    @endauth

</li>


