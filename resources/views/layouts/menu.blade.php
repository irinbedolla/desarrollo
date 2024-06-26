<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class="fas fa-home"></i></i></i><span class="text-dark">Inicio</span>
    </a>
    @auth
        @role('Super Usuario')
            <a class="nav-link" href="/usuarios">
                <i class="fas fa-users"></i></i><span class="text-dark">Usuarios</span>
            </a>
            <a class="nav-link" href="/roles">
                <i class="fas fa-user-shield"></i></i><span class="text-dark">Roles</span>
            </a>
            <a class="nav-link" href="/poderes">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="/capacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="/miscapacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="/expedientes">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth
    @auth
        @role('Administrador')
            <a class="nav-link" href="/usuarios">
                <i class="fas fa-users"></i></i><span class="text-dark">Usuarios</span>
            </a>
            <a class="nav-link" href="/poderes">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="/capacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="/miscapacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="/expedientes">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth

    @auth
        @role('Auxiliar')
            <a class="nav-link" href="/poderes">
                <i class="fas fa-id-card"></i></i><span class="text-dark">Poderes</span>
            </a>
            <a class="nav-link" href="/miscapacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="/expedientes">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth
    
    @auth
        @role('Capacitacion Admin')
            <a class="nav-link" href="/capacitaciones">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark">Capacitaciones</span>
            </a>
            <a class="nav-link" href="/expedientes">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark">Expediente</span>
            </a>
        @endrole
    @endauth

    

    
</li>
