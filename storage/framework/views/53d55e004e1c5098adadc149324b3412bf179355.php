

<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Crear Roles</h3>

                            <!--Se realiza la validación de campos para ver si dejó alguno vacío-->
                            <?php if($errors->any()): ?>
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                            <!--<span class="badge badge-danger"><?php echo e($error); ?></span>-->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                            <?php echo Form::open(array('route'=>'roles.store', 'method'=>'POST', 'class' => 'needs-validation','novalidate', 'id' => 'form_roles')); ?>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre del Rol</label>
                                            <?php echo Form::text('name', null, array('class'=>'form-control', 'required' => 'required')); ?>

                                        </div>
                                    </div>         
                                    <div class="invalid-feedback">
                                        El tipo es obligatorio.
                                    </div>              

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Permisos para este Rol</label>
                                                <br/>
                                            <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <label>
                                                    <?php echo e(Form::checkbox('permission[]', $value->id, false, array('class' => 'name'))); ?>

                                                    <?php echo e($value->name); ?>                                                    
                                                </label>
                                                <br/>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                        <div class="invalid-feedback">
                                        El tipo es obligatorio.
                                    </div>
                                    </div>                                    
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                        <?php echo Form::close(); ?>

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
    <script src="../public/js/roles/roles.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\trabajo\resources\views/roles/crear.blade.php ENDPATH**/ ?>