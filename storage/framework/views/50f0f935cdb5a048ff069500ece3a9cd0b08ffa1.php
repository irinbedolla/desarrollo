
<li class="side-menus <?php echo e(Request::is('*') ? 'active' : ''); ?>">
    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Super Usuario')): ?>
            <a class="nav-link" href="<?php echo e(route('usuarios')); ?>">
                <i class="fas fa-users"></i></i><span class="text-dark" onclick="usuarios()">Usuarios</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('roles')); ?>">
                <i class="fas fa-user-shield"></i></i><span class="text-dark" onclick="roles()">Roles</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('capacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="revista()">Revista</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer.estadistica')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('turnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('misturnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('turno_estadistica')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('registro')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Registro</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Administrador')): ?>
            <a class="nav-link" href="<?php echo e(route('usuarios')); ?>">
                <i class="fas fa-users"></i></i><span class="text-dark" onclick="usuarios()">Usuarios</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('roles')); ?>">
                <i class="fas fa-user-shield"></i></i><span class="text-dark" onclick="roles()">Roles</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('capacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
            <a class="nav-link" href="#">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="revista()">Revista</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer.estadistica')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('turnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('misturnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('turno_estadistica')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Auxiliar')): ?>
            <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('misturnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>   
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Conciliador')): ?>
        |   <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Notificador')): ?>
            <a class="nav-link" href="<?php echo e(route('seer')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Capacitacion Admin')): ?>
            <a<a class="nav-link" href="<?php echo e(route('capacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="capacitaciones()">Capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Delegado')): ?>
            <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer.estadistica')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('turno_estadistica')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica_turno()">Estadistica turno</span>
            </a> 
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Estadistica')): ?>
            <a class="nav-link" href="<?php echo e(route('seer.estadistica')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">Estadisticas</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>    


    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Turnos')): ?>
            <a class="nav-link" href="<?php echo e(route('turnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Turnos</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Registro')): ?>
            <a class="nav-link" href="<?php echo e(route('.0000000')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Registro</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>
    
    <?php if(auth()->guard()->check()): ?>
        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'Excepcion')): ?>
            <a class="nav-link" href="<?php echo e(route('poderes')); ?>">
                <i class="fas fa-id-card"></i></i><span class="text-dark" onclick="poderes()">Poderes</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('seer')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="estadistica()">SEER</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('misturnos')); ?>">
                <i class="fa fa-book" aria-hidden="true"></i></i><span class="text-dark" onclick="turnos()">Mis turnos</span>
            </a>   
            <a class="nav-link" href="<?php echo e(route('miscapacitaciones')); ?>">
                <i class="fa fa-suitcase" aria-hidden="true"></i></i><span class="text-dark" onclick="mis_capacitaciones()">Mis capacitaciones</span>
            </a>
            <a class="nav-link" href="<?php echo e(route('expedientes')); ?>">
                <i class="fas fa-folder" aria-hidden="true"></i></i><span class="text-dark" onclick="expedientes()">Expediente</span>
            </a>
        <?php endif; ?>
    <?php endif; ?>
</li>


<?php /**PATH C:\xampp\htdocs\trabajo\resources\views/layouts/menu.blade.php ENDPATH**/ ?>