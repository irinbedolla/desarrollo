@extends('layouts.app_editar')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Editar registro</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Editar registro</h3>
                            
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
                            {!! Form::model($registro, ['method' => 'PATCH', 'route' => ['registro.update', $registro->id], 'class' => 'needs-validation','novalidate']) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Nombre</label>
                                            {!! Form::text('nombre', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El nombre es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            {!! Form::email('correo', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El Email es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Celular</label>
                                            {!! Form::text('celular', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El Email es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">Estado</label>
                                            {!! Form::text('estado', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        El Email es obligatorio.
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Estatus</label>
                                            <select name="genero" class="form-control">
                                                <option value="Validado">Validado</option>
                                                <option value="Pendiente">Pendiente</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                El estatus es obligatorio.
                                            </div>
                                        </div>
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