@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Poder</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Editar Poder</h3>

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
                            {!! Form::model($poder, ['method' => 'PATCH', 'files' => true, 'route' => ['poderes.update', $poder ,$poder->id]] ) !!}
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nombres</label>
                                        <input type="text" class="form-control" value="{{ $poder->nombres }}" name="nombresAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Apellidos</label>
                                        <input type="text" class="form-control" value="{{ $poder->apellidos }}" name="apellidosAbogadoAlta" id="apellidosAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Teléfono</label>
                                        <input type="text" class="form-control" value="{{ $poder->telefono }}"  name="telefonoAbogadoAlta" maxlength="10" pattern="[0-9]+" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Correo</label>
                                        <input type="email" class="form-control" value="{{ $poder->email }}" name="correoAbogadoAlta" id="correoAbogadoAlta" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Empresa</label>
                                        <input type="text" class="form-control" value="{{ $poder->empresa }}" name="empresaAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">CURP</label>
                                        <input type="text" class="form-control" value="{{ $poder->curp }}" aria-label="CURP" name="curpAbogadoAlta"maxlength="18" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Domicilio</label>
                                        <input type="text" class="form-control" value="{{ $poder->domicilio }}" name="domicilioAbogadoAlta" oninput="this.value = this.value.toUpperCase()" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">RFC</label>
                                        <input type="text" class="form-control" placeholder="RFC Empresa" name="RFCAbogadoAlta" maxlength="10" oninput="this.value = this.value.toUpperCase()">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Fecha vigencia</label>
                                        <input type="date" class="form-control" value="{{ $poder->fechaVigencia }}" name="fechaVigenciaAlta" id="fechaVigenciaAlta" min="<?= date("Y-m-d") ?>" required>
                                    </div>
                                </div>
                                
                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Industria</label>
                                        <input type="text" class="form-control" value="{{ $poder->industria }}" name="industriaAlta" required>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <span class="" id="basic-addon1">*Seleccione la region(nes).</i></i></span>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="moreliaSucursal" value="Si" @php if($poder->regionMorelia === "Si") echo "checked"  @endphp>
                                            <label class="form-check-label" for="flexCheckDefault">Morelia</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="uruapanSucursal" value="Si" @php if($poder->regionUruapan === "Si") echo "checked"  @endphp>
                                            <label class="form-check-label" for="flexCheckChecked">Uruapan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="zamoraSucursal" value="Si" @php if($poder->regionZamora === "Si") echo "checked"  @endphp>
                                            <label class="form-check-label" for="flexCheckDefault">Zamora</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label for="">Descripción del poder</label>
                                        <textarea class="form-control" aria-describedby="basic-addon1" name="descripcionpoderAlta" required>{{ $poder->poder }}</textarea>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="">Estatus</label>
                                        <select class="form-control" name="estatus" required>
                                            <option value="Pendiente" @php if($poder->estatus === "Pendiente") echo "selected"  @endphp>Pendiente</option>
                                            <option value="Validado" @php if($poder->estatus === "Validado") echo "selected"  @endphp>Validado</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>*Identificación oficial</label><br>
                                        <a target="_blank" class="btn btn-primary" href="../../documentos/{{$poder->ine}}">Existente</a>
                                        {!! Form::file('documentoIne', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>*Documento que acredite la representación</label><br>
                                        <a target="_blank" class="btn btn-primary" href="../../documentos/{{$poder->representacion}}">Existente</a>
                                        {!! Form::file('documentoRepresentacion', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Anexos</label><br>
                                        @php
                                            if($poder->anexo === "Sin anexo")
                                                echo "<td>S/A</td>";
                                            else
                                                echo "<a target='_blank'  class='btn btn-primary' href='documentos/$poder->anexo'>PDF</a>";
                                        @endphp
                                        {!! Form::file('documentoAnexo', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label>Anexos 2</label><br>
                                        @php
                                            if($poder->cedula === "Sin anexo")
                                                echo "<td>S/A</td>";
                                            else
                                                echo "<a target='_blank' class='btn btn-primary' href='documentos/$poder->cedula'>PDF</a>";
                                        @endphp
                                        {!! Form::file('documentoPoder', ['class' => 'form-control-file', 'accept' => '.pdf']) !!}
                                    </div>
                                </div>


                                <div>
                                {!! Form::open(array('route' => 'poderes.store', 'method' => 'POST')) !!}
                                <input type="hidden" name="id" value="{{ Auth::id() }}">
                                </div>
                                
                                

                                </div>                                    
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    {!! Form::close() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

