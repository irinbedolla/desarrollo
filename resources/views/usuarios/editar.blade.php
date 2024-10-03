@extends('layouts.app_editar')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar Usuario</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Editar Usuario</h3>
                            
                            <!--Se realiza la validación de campos para ver si dejó alguno vacío-->
                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            <!--<span class="badge badge-danger">{{ $error }}</span>-->
                                        @endforeach
                                    </ul>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            @endif

                            <!--Se realiza el envío de datos con formulario de Laravel Collective-->
                            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['usuarios.update', $user->id], 'class' => 'needs-validation','novalidate', 'id' => 'form_usuarios']) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El nombre es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            {!! Form::email('email', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El Email es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            {!! Form::password('password', array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        La contraseña es obligatoria.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="confirm-password">Confirmar Password</label>
                                            {!! Form::password('confirm-password', array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        La contraseña es obligatoria.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Roles</label>
                                            {!! Form::select('roles[]', $roles,$userRole, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Debes seleccionar un Rol.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Delegacion</label>
                                            <select name="delegacion" class="form-control">
                                                <option value="Morelia" {{ $user["delegacion"] == 'Morelia' ? "selected" : '' }}>Morelia</option>
                                                <option value="Uruapan" {{ $user['delegacion'] == 'Uruapan' ? "selected" : '' }}>Uruapan</option>
                                                <option value="Zamora"  {{ $user['delegacion'] == 'Zamora' ? "selected" : '' }}>Zamora</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        La delegacion es obligatoria.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Tipo</label>
                                            <select name="type" class="form-control">
                                                <option value="Seer" {{ $user["type"] == 'Seer' ? "selected" : '' }}>Seer</option>
                                                <option value="Si concilio" {{ $user["type"] == 'Si concilio' ? "selected" : '' }}>Si concilio</option>
                                                <option value="Ambos" {{ $user["type"] == 'Ambos' ? "selected" : '' }}>Ambos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El tipo es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary" style="background-color: #6A0F49">Guardar</button>
                                    </div>
                                    
                                </div>
                            {!! Form::close() !!}
        

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div id="menu_carga" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>


@section('scripts')
    <script src="../../public/js/usuarios/usuarios.js"></script>
@endsection