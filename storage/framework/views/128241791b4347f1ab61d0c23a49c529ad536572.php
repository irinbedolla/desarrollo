

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Usuarios</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('crear-usuario')): ?>
                                <a class="btn btn-warning" href="<?php echo e(route('usuarios.create')); ?>" onclick=crear_usuario();> Nuevo</a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-usuario')): ?>
                                <div class="table-responsive">
                                    <table id="example" class="table-striped" style="width:100%">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">E-mail</th>
                                            <th style="color: #fff;">Rol</th>
                                            <th style="color: #fff;">Delegacíon</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody class="contenidobusqueda">
                                            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td style="display: none;"><?php echo e($usuario->id); ?></td>
                                                    <td><?php echo e($usuario->name); ?></td>
                                                    <td><?php echo e($usuario->email); ?></td>
                                                    <td>                                                
                                                        <?php if(!empty($usuario->getRoleNames())): ?>
                                                            <?php $__currentLoopData = $usuario->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rolName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <h5><span class="badge badge-dark"><?php echo e($rolName); ?></span></h5>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e($usuario->delegacion); ?></td>
                                                    <td>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar-usuario')): ?>
                                                            <a class="btn btn-info" href="<?php echo e(route('usuarios.edit', $usuario->id)); ?>" onclick=editar_usuario();>Editar</a>
                                                        <?php endif; ?>
                                                        <!--Utilizamos las librerías de laravel collective para hacer la 
                                                        eliminación más sencilla con un formulario utilizando el metodo DELETE-->
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('borrar-usuario')): ?>
                                                            <?php echo Form::open(['method'=>'DELETE', 'route'=> ['usuarios.destroy', $usuario->id], 'style'=>'display:inline']); ?>

                                                                <?php echo Form::submit('Borrar', ['class'=> 'btn btn-danger', 'onclick' => 'editar_usuario()']); ?>

                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php endif; ?>
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                               
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<div id="nuevo_usuario" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


<?php $__env->startSection('scripts'); ?>
    <script src="../public/js/usuarios/usuarios.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\trabajo\resources\views/usuarios/index.blade.php ENDPATH**/ ?>