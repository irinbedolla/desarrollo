@extends('layouts.app')
@php
    $fechaActual = date('Y-m-d');
@endphp
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Segundo encuentro</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            

                            @can('crear-registro')
                                <a class="btn btn-warning" href="{{ route('registro.create') }}"  onclick=nuevo_poder();> Nuevo</a>
                            @endcan
                            
                            @can('ver-registro')
                                <div class="table-responsive">
                                    <table id="tabla_abogados" class="table table-striped mt-2">
                                        <thead style="background-color: #4A001F;">
                                            <th style="color: #fff;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">Telefono</th>
                                            <th style="color: #fff;">Correo</th>
                                            <th style="color: #fff;">Estado</th>
                                            <th style="color: #fff;">Género</th>
                                            <th style="color: #fff;">Estatus</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($registros as $registro)
                                                <tr>
                                                    <td>{{$registro->id}}</td>
                                                    <td>{{$registro->nombre}}</td>
                                                    <td>{{$registro->celular}}</td>
                                                    <td>{{$registro->correo}}</td>
                                                    <td>{{$registro->estado}}</td>
                                                    <td>{{$registro->genero}}</td>
                                                    <td>{{$registro->estatus}}</td>
                                                    <td><a class="btn btn-info" href="{{ route('registro.edit', $registro->id)}}" onclick=editar_poder();>Editar</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan

                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $registros->links() !!}
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

<div id="nuevo_poder" style ="display: none;">
    <div>.</div>
    <div class="loader"></div>
</div>

@section('scripts')
    <script src="../public/js/poderes/general.js"></script>
@endsection
