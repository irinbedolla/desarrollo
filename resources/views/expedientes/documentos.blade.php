@extends('layouts.app_editar')

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
                            <a class="btn btn-warning" href="{{ route('expedientes') }}"> Regresar</a>
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
                                                    <td><a target="_blank" href="../../storage/app/documentos_personal/{{$doc->titulo}}">PDF</a></td>
                                                    <td><a target="_blank" href="../../storage/app/documentos_personal/{{$doc->nivel_estudios}}">PDF</a></td>
                                                    @if($doc->especialidad == null)
                                                        <td>S/E</td>
                                                    @else 
                                                        <td><a target="_blank" href="../../storage/app/documentos_personal/{{$doc->especialidad}}">PDF</a></td>
                                                    @endif
                                                    @if($doc->diplomado == null)
                                                        <td>S/D</td>
                                                    @else 
                                                        <td><a target='_blank' href='../../storage/app/documentos_personal/{{$doc->diplomado}}'>PDF</a></td>
                                                    @endif
                                                    @if($doc->seminario == null)
                                                        <td>S/S</td>
                                                    @else 
                                                        <td><a target='_blank' href='../../storage/app/documentos_personal/{{$doc->seminario}}'>PDF</a></td>
                                                    @endif
                                                    @if($doc->cursos == null)
                                                        <td>S/C</td>
                                                    @else
                                                        <td><a target='_blank' href='../../storage/app/documentos_personal/{{$doc->cursos}}'>PDF</a></td>
                                                    @endif
                                                    @if($doc->desarrollo == null)
                                                        <td>S/D</td>
                                                    @else 
                                                        <td><a target='_blank' href='../../storage/app/documentos_personal/{{$doc->desarrollo}}'>PDF</a></td>
                                                    @endif
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

