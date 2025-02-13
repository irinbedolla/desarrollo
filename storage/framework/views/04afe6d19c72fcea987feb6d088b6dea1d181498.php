

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            
                            <a class="btn btn-warning" href="<?php echo e(route('roles.create')); ?>" onclick=crear_rol();>Nuevo</a>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped mt-2">
                                    <thead style="background-color:#4A001F">
                                        <th style="color:#fff">Rol</th>
                                        <th style="color:#fff">Acciones</th>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($role->name); ?></td>
                                            <td>
                                                
                                                    <a class="btn btn-primary" href="<?php echo e(route('roles.edit', $role->id)); ?>" onclick=editar_rol();>Editar</a>
                                                

                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style'=>'display:inline' ]); ?>

                                                        <?php echo Form::submit('Borrar', ['class' => 'btn btn-danger', 'onclick' => 'editar_rol()']); ?>

                                                    <?php echo Form::close(); ?>

                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

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

<div id="menu_carga" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


<?php $__env->startSection('scripts'); ?>
    <script src="../public/js/general/menu.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\trabajo\resources\views/roles/index.blade.php ENDPATH**/ ?>