@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Registro</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Alta de persona</h3>
                             
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
                            {!! Form::open(array('route'=>'registro.store', 'method'=>'POST', 'class' => 'needs-validation','novalidate')) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            {!! Form::text('nombre', null, array('class'=>'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                El nombre es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            {!! Form::email('correo', null, array('class'=>'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                El Email es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password">Celular</label>
                                            {!! Form::text('celular',null, array('class'=>'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                La celular es obligatoria.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="confirm-password">Estado</label>
                                            {!! Form::text('estado',null, array('class'=>'form-control', 'required')) !!}
                                            <div class="invalid-feedback">
                                                La estado es obligatoria.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Género</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Mujer">Mujer</option>
                                                <option value="Hombre">Hombre</option>
                                                <option value="Otros">Otros</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                El género es obligatorio.
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
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
    <script src="../public/js/usuarios/usuarios.js"></script>
@endsection