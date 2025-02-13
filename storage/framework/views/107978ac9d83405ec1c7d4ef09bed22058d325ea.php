

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
                            <h3 class="text-center">Alta de Usuarios</h3>
                             
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
                            <?php echo Form::open(array('route'=>'usuarios.store', 'method'=>'POST', 'class' => 'needs-validation','novalidate')); ?>

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            <?php echo Form::text('name', null, array('class'=>'form-control', 'required')); ?>

                                            <div class="invalid-feedback">
                                                El nombre es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <?php echo Form::email('email', null, array('class'=>'form-control', 'required')); ?>

                                            <div class="invalid-feedback">
                                                El Email es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <?php echo Form::password('password', array('class'=>'form-control', 'required')); ?>

                                            <div class="invalid-feedback">
                                                La contraseña es obligatoria.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="confirm-password">Confirmar Password</label>
                                            <?php echo Form::password('confirm-password', array('class'=>'form-control', 'required')); ?>

                                            <div class="invalid-feedback">
                                                La contraseña es obligatoria.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Roles</label>
                                            <?php echo Form::select('roles[]', $roles,[], array('class'=>'form-control', 'required')); ?>

                                            <div class="invalid-feedback">
                                                Debes seleccionar un Rol.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Delegacion</label>
                                            <select name="delegacion" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Morelia">Morelia</option>
                                                <option value="Uruapan">Uruapan</option>
                                                <option value="Zamora">Zamora</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                La delegacion es obligatoria.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tipo</label>
                                            <select name="type" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Seer">Seer</option>
                                                <option value="Si concilio">Si concilio</option>
                                                <option value="Ambos">Ambos</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                El tipo es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                    
                                </div>
                            <?php echo Form::close(); ?>

        

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
    <script src="../public/js/usuarios/usuarios.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\trabajo\resources\views/usuarios/crear.blade.php ENDPATH**/ ?>