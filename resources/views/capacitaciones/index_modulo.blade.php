@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Capacitaciones</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-curso')
                                <a class="btn btn-warning" href="{{ route('capacitaciones.nuevo_modulo', $capacitacion->id) }}"> Agregar módulo</a>
                            @endcan
                                <a class="btn btn-info" href="{{ route('capacitaciones') }}"> Regresar</a>
                            @can('ver-curso')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Modulo</th>
                                            <th style="color: #fff;">Introducción</th>
                                            <th style="color: #fff;">Desarrollo</th>
                                            <th style="color: #fff;">Anexo 1</th>
                                            <th style="color: #fff;">Anexo 2</th>
                                            <th style="color: #fff;">Anexo 3</th>
                                            <th style="color: #fff;">Anexo 4</th>
                                            <th style="color: #fff;">Anexo 5</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($modulos as $modulo)
                                                <tr>
                                                    <td>{{$modulo->nombre}}</td>
                                                    <td>{{$modulo->introduccion}}</td>
                                                    <td>{{$modulo->desarrollo}}</td>
                                                    @php
                                                    if($modulo->anexo1 == null){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../storage/app/documentos_modulo/$modulo->anexo1'>PDF</a></td>";
                                                    }
                                                    if($modulo->anexo2 == null){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../storage/app/documentos_modulo/$modulo->anexo2'>PDF</a></td>";
                                                    }
                                                    if($modulo->anexo3 == null){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../storage/app/documentos_modulo/$modulo->anexo3'>PDF</a></td>";
                                                    }
                                                    if($modulo->anexo4 == null){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../storage/app/documentos_modulo/$modulo->anexo4'>PDF</a></td>";
                                                    }
                                                    if($modulo->anexo5 == null){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../storage/app/documentos_modulo/$modulo->anexo5'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                    <td>
                                                        <a class="btn btn-success" href="{{ route('capacitaciones.editar_encuesta', ['id' => $capacitacion->id, 'mod' => $modulo->id_modulo] )}}">Encuesta</a>
                                                        <a class="btn btn-info"    href="{{ route('capacitaciones.editar_modulo', $modulo->id)}}">Editar</a>
                                                        <a class="btn btn-danger" href="{{ route('capacitaciones.borrar', ['id' => $capacitacion->id, 'mod' => $modulo->id_modulo]) }}"> Borrar</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                               
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

