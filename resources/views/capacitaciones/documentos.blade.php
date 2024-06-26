@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Documentos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-warning" href="{{ route('capacitaciones.personas') }}"> Regresar</a>
                                <div class="table-responsive">
                                    <table class="table table-striped mt-1">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Titulo</th>
                                            <th style="color: #fff;">Nivel Estudios</th>
                                            <th style="color: #fff;">Especialidades</th>
                                            <th style="color: #fff;">Diplomados</th>
                                            <th style="color: #fff;">Seminario</th>
                                            <th style="color: #fff;">Cursos</th>
                                            <th style="color: #fff;">Desarrollo</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                @foreach($documentos as $doc)
                                                    <td><a target="_blank" href="../../documentosPersonal/{{$doc->titulo}}">PDF</a></td>
                                                    <td><a target="_blank" href="../../documentosPersonal/{{$doc->nivel_estudios}}">PDF</a></td>
                                                    @php
                                                    if($doc->especialidad == null){
                                                        echo "<td>S/E</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../documentosPersonal/$doc->especialidad'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                    @php
                                                    if($doc->diplomado == null){
                                                        echo "<td>S/D</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../documentosPersonal/$doc->diplomado'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                    @php
                                                    if($doc->seminario == null){
                                                        echo "<td>S/S</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../documentosPersonal/$doc->seminario'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                    @php
                                                    if($doc->cursos == null){
                                                        echo "<td>S/C</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../documentosPersonal/$doc->cursos'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                    @php
                                                    if($doc->desarrollo == null){
                                                        echo "<td>S/D</td>";
                                                    }else{ 
                                                        echo "<td><a target='_blank' href='../../documentosPersonal/$doc->desarrollo'>PDF</a></td>";
                                                    }
                                                    @endphp
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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

