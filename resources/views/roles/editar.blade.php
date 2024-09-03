@extends('layouts.app_editar')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Roles</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Editar Rol y permisos</h3>

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
                            {!! Form::model($role, ['method' => 'PATCH', 'route' => ['roles.update', $role->id]]) !!}
                            <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Nombre del Rol: </label>
                                            {!! Form::text('name', null, array('class'=>'form-control')) !!}
                                        </div>
                                    </div>                       

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="">Permisos para este Rol</label>
                                                <br/>
                                                @foreach($permission as $value)
                                                    <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermission) ? true : false, array('class' => 'name')) }}
                                                    {{ $value->name }}</label>
                                                <br/>
                                                @endforeach
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary" style="background-color: #6A0F49">Guardar</button>
                                
                                    
                                </div>
                            {!! Form::close() !!}

                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

