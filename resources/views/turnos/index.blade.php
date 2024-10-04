@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Turnos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('crear-turnos')
                                <a class="btn btn-warning" href="{{ route('turnos.create') }}" onclick=crear_turnos();> Nuevo</a>
                            @endcan

                            @can('ver-usuario')
                                <div class="table-responsive">
                                    <table id="tabla_usuarios" class="table table-striped mt-2">
                                        <thead style="background-color: #4A001F;">
                                            <th style="display: none;">ID</th>
                                            <th style="color: #fff;">Nombre</th>
                                            <th style="color: #fff;">E-mail</th>
                                            <th style="color: #fff;">Rol</th>
                                            <th style="color: #fff;">Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach($turnos as $turno)
                                                <tr>
                                                    <td style="display: none;">{{$turno->id}}</td>
                                                    <td>{{$turno->name}}</td>
                                                    <td>{{$turno->email}}</td>
                                                    <td>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endcan
                            <!-- Centramos la paginación a la derecha-->
                            <div class="pagination justify-content-end">
                                {!! $turnos->links() !!}
                            </div>                        
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
    <script src="../public/js/general/menu.js"></script>
@endsection