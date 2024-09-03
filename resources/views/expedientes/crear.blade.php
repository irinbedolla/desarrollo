@extends('layouts.app_editar')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Mis datos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Actualizar mis datos</h3>
                            
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
                            {!! Form::open(array('route'=>'expedientes.store', 'method'=>'POST', 'files' => true)) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        *Los campos con (*) son obligatorios.
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">*Nombre</label>
                                            {!! Form::text('nombre', $usuario->name , array('class'=>'form-control', 'readonly')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="email">*Email</label>
                                            {!! Form::email('email', $usuario->email, array('class'=>'form-control', 'readonly')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="password">*Cargo</label>
                                            {!! Form::text('cargo', ($persona != null) ? $persona->cargo : null, array('class'=>'form-control', 'required')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="confirm-password">*Area de adscripción</label>
                                            {!! Form::text('area_adcripcion', ($persona != null) ? $persona->area_adcripcion : null , array('class'=>'form-control', 'required')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">*Telefono</label>
                                            {!! Form::text('telefono', ($persona != null) ? $persona->telefono : null , array('class'=>'form-control', 'required', 'maxlength=10')) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">*Título</label>
                                            {!! Form::text('tilulo_universitario', ($persona != null) ? $persona->tilulo_universitario : null , array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>*Documento del título</label><br>
                                            {!! Form::file('documentoTitulo', ['class' => 'form-control-file', 'accept' => '.pdf'] ) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">*Nivel de estudios</label>
                                            {!! Form::text('estudio_maximo', ($persona != null) ? $persona->estudio_maximo : null , array('class'=>'form-control',) ) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>*Documento del estudios</label><br>
                                            {!! Form::file('documentoEstudios', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Especialidades</label>
                                            {!! Form::text('especialidades', ($persona != null) ? $persona->especialidades : null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Documento del especialidades</label><br>
                                            {!! Form::file('documentoEspecialidades', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Diplomados</label>
                                            {!! Form::text('diplomados', ($persona != null) ? $persona->diplomados : null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Documento del diplomado</label><br>
                                            {!! Form::file('documentoDiplomado', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Seminarios</label>
                                            {!! Form::text('seminarios', ($persona != null) ? $persona->seminarios : null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Documento del seminario</label><br>
                                            {!! Form::file('documentoSeminario', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Cursos</label>
                                            {!! Form::text('cursos',  ($persona != null) ? $persona->cursos : null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Documento del los cursos</label><br>
                                            {!! Form::file('documentoCursos', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label for="name">Acciones de desarrollo <abbr title="Documentos ">Ayuda</abbr> </label>
                                            {!! Form::text('acciones_desarrollo',  ($persona != null) ? $persona->acciones_desarrollo : null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label>Documento del desarrollo</label><br>
                                            {!! Form::file('documentoDesarrollo', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12">
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

