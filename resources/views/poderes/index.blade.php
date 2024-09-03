@extends('layouts.app')
@php
    $fechaActual = date('Y-m-d');
@endphp
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Poderes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            

                            @can('crear-abogado')
                                <a class="btn btn-warning" href="{{ route('poderes.create') }}"> Nuevo</a>
                            @endcan
                            
                            @can('ver-abogado')
                                <div class="table-responsive">
                                    <table class="table table-striped mt-2">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombres</th>
                                            <th style="color: #fff;">Apellidos</th>
                                            <th style="color: #fff;">Telefono</th>
                                            <th style="color: #fff;">Poder</th>
                                            <th style="color: #fff;">Fecha Vigencia</th>
                                            <th style="color: #fff;">Vigencia Representación</th>
                                            <th style="color: #fff;">Estatus Abogado</th>
                                            <th style="color: #fff;">INE/Cedula</th>
                                            <th style="color: #fff;">Representacion</th>
                                            <th style="color: #fff;">Anexo</th>
                                            <th style="color: #fff;">Anexo 2</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($poderes as $persona)
                                                <tr>
                                                    <td style="display: none;">{{$persona->idAbogado}}</td>
                                                    <td>{{$persona->nombres}}</td>
                                                    <td>{{$persona->apellidos}}</td>
                                                    <td>{{$persona->telefono}}</td>
                                                    <td>{{$persona->empresa}}</td>
                                                    <td>{{$persona->fechaVigencia}}</td>
                                                    @php
                                                    if($persona->fechaVigencia >= $fechaActual){
                                                        echo'<td>Vigente</td>';
                                                    }
                                                    elseif($persona->fechaVigencia  < $fechaActual) {
                                                        echo'<td>Vencido</td>';
                                                    }
                                                    @endphp
                                                    <td>{{$persona->estatus}}</td>
                                                    <td><a target="_blank" href="../storage/app/documentos_abogados/{{$persona->ine}}">PDF</a></td>
                                                    <td><a target="_blank" href="../storage/app/documentos_abogados/{{$persona->representacion}}">PDF</a></td>
                                                    @php
                                                    if($persona->anexo === "Sin anexo"){
                                                        echo "<td>S/A</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../storage/app/documentos_abogados/$persona->anexo'>PDF</a></td>";
                                                    }
                                                    if($persona->cedula === "Sin anexo"){
                                                        echo "<td>S/A</td>";
                                                    }else{
                                                        echo "<td><a target='_blank' href='../storage/app/documentos_abogados/$persona->cedula'>PDF</a></td>";
                                                    }
                                                    @endphp

                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            @can('editar-abogado')
                                                                <a class="btn btn-info" href="{{ route('poderes.edit', $persona->idAbogado)}}">Editar</a>
                                                            @endcan
                                                            @can('borrar-abogado')
                                                            {!! Form::open(['method'=>'DELETE', 'route'=> ['poderes.destroy', $persona->idAbogado], 'style'=>'display:inline']) !!}
                                                                {!! Form::submit('Borrar', ['class'=> 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}
                                                            @endcan
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan

                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $poderes->links() !!}
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

