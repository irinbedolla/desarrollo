<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\User;
use App\Models\Documentos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

//Para sacar el Id del usuario
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ExpedienteController extends Controller
{
    function __contruct()
    {
        $this->middleware('permission:ver-persona | crear-persona | editar-persona | borrar-persona', ['only'=>['index']]);
        $this->middleware('permission:crear-persona', ['only'=>['create','store']]);
        $this->middleware('permission:editar-persona',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-persona',['only'=>['destroy']]);
    }

    public function index()
    {
        //Depediendo del rol va regresar un listado o un solo registro
        $id = auth()->user()->id;
        $usuario = User::find($id);
        $rol = $usuario->getRoleNames()->first();
        if($rol == "Super Usuario" || $rol == 'Capacitacion Admin'){
            $personas = Persona::paginate(10);
        }
        else{
            //Si la persona no existe va mandar una vandera 
            $personas = Persona::where('id_usuario', $id)->get();
            if($personas == null){
                $personas = "no existe";
            }
        }
        
        return view('expedientes.index', compact('personas'));
    }


    
    public function edit($id)
    {
        //$id = auth()->user()->id;
        $usuario = User::find($id);
        $persona = Persona::where('id_usuario', $id)->first();
        return view('expedientes.crear', compact('usuario','persona'));
    }


    public function store(Request $request)
    {
        $id = auth()->user()->id;
        $data = $request->all();
        $data_doc = [];
        $data_doc['id_usuario'] = $id;

        //Validar documentacion
        request()->validate([
            'nombre'                    => 'required',
            'email'                     => 'required',
            'cargo'                     => 'required',
            'area_adcripcion'           => 'required',
            'telefono'                  => 'required|digits:10',
            'tilulo_universitario'      => 'required',
            'documentoTitulo'           => 'nullable',
            'estudio_maximo'            => 'required',
            'documentoEstudios'         => 'nullable',
            'especialidades'            => 'nullable',
            'documentoEspecialidades'   => 'nullable',
            'diplomados'                => 'nullable',
            'documentoDiplomado'        => 'nullable',
            'seminarios'                => 'nullable',
            'documentoSeminario'        => 'nullable',
            'cursos'                    => 'nullable',
            'documentoCursos'           => 'nullable',
            'acciones_desarrollo'       => 'nullable',
            'documentoDesarrollo'       => 'nullable',
        ], $data);
        
        $data['id_usuario'] = $id;
        
        //Validar que ya existe registro
        $persona = Persona::where(['id_usuario' => $id])->first();

        //Si no existe se va registro
        if($persona == null){
            //documento de titulo
            $nombretitulo = $data["nombre"]."_Titulo.pdf";
            $path = Storage::putFileAs(
                'documentos_personal', $request->file('documentoTitulo'), $nombretitulo
            );
            $data_doc['titulo'] = $nombretitulo;


            //documento de Estudios
            $nombreestudios = $data["nombre"]."_Estudios.pdf";
            $path = Storage::putFileAs(
                'documentos_personal', $request->file('documentoEstudios'), $nombreestudios
            );
            $data_doc['nivel_estudios'] = $nombreestudios;



            //documento de Especialidades si lo selecciona
            if(isset($data["documentoEspecialidades"])){
                $nombreespecialidades = $data["nombre"]."_Especialidades.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoEspecialidades'), $nombreespecialidades
                );
                $data_doc['especialidad'] = $nombreespecialidades;
            }


            //documento de diplomado
            if(isset($data["documentoDiplomado"])){
                $nombrediplomado = $data["nombre"]."_Diplomados.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoDiplomado'), $nombrediplomado
                );
                $data_doc['diplomado'] = $nombrediplomado;
            }


            if(isset($data["documentoSeminario"])){
                $nombreseminario = $data["nombre"]."_Diplomados.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoSeminario'), $nombreseminario
                );
                $data_doc['seminario'] = $nombreseminario;
            }


            if(isset($data["documentoCursos"])){
                $nombrecursos = $data["nombre"]."_Cursos.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoCursos'), $nombrecursos
                );
                $data_doc['cursos'] = $nombrecursos;
            }


            if(isset($data["documentoDesarrollo"])){
                $nombredesarrollo = $data["nombre"]."_Desarrollo.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoDesarrollo'), $nombredesarrollo
                );
                $data_doc['desarrollo'] = $nombredesarrollo;
            }

            //dd($data);
            Persona::create($data);
            Documentos::create($data_doc);  
            return redirect()->route('expedientes.index')->with('success', 'Datos actualizados correctamente.'); 
        }
        //Si ya existe se va actualizar
        else{
            //documento de titulo
            if(isset($data["documentoTitulo"])){
                $nombretitulo = $data["nombre"]."_Titulo.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoTitulo'), $nombretitulo
                );
                $data_doc['titulo'] = $nombretitulo;
            }


            //documento de Estudios
            if(isset($data["documentoEstudios"])){
                $nombreestudios = $data["nombre"]."_Estudios.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoEstudios'), $nombreestudios
                );
                $data_doc['nivel_estudios'] = $nombreestudios;
            }


            //documento de Especialidades si lo selecciona
            if(isset($data["documentoEspecialidades"])){
                $nombreespecialidades = $data["nombre"]."_Especialidades.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoEspecialidades'), $nombreespecialidades
                );
                $data_doc['especialidad'] = $nombreespecialidades;
            }


            //documento de diplomado
            if(isset($data["documentoDiplomado"])){
                $nombrediplomado = $data["nombre"]."_Diplomados.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoDiplomado'), $nombrediplomado
                );
                $data_doc['diplomado'] = $nombrediplomado;
            }


            if(isset($data["documentoSeminario"])){
                $nombreseminario = $data["nombre"]."_Diplomados.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoSeminario'), $nombreseminario
                );
                $data_doc['seminario'] = $nombreseminario;
            }


            if(isset($data["documentoCursos"])){
                $nombrecursos = $data["nombre"]."_Cursos.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoCursos'), $nombrecursos
                );
                $data_doc['cursos'] = $nombrecursos;
            }


            if(isset($data["documentoDesarrollo"])){
                $nombredesarrollo = $data["nombre"]."_Desarrollo.pdf";
                $path = Storage::putFileAs(
                    'documentos_personal', $request->file('documentoDesarrollo'), $nombredesarrollo
                );
                $data_doc['desarrollo'] = $nombredesarrollo;
            }


            $capacitacion = Persona::where('id_usuario', $id)->first();
            $capacitacion->update($data);

            $documentos = Documentos::where('id_usuario', $id)->first();
            $documentos->update($data_doc);  
            return redirect()->route('expedientes.index')->with('success', 'Datos actualizados correctamente.'); 
        }
    }

    public function personas_documentos($id){
        $documentos = Documentos::where('id_usuario', $id)->get();
        return view('expedientes.documentos', compact('documentos'));
    }
}
