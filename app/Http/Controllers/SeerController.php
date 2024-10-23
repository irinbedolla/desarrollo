<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\SeerAuxiliares;
use App\Models\SeerNotificadores;
use App\Models\SeerConciliadores;
use App\Models\SeerDelegados;
//Para sacar el Id del usuario
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sedes;
use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;


class SeerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Se agrega un constructor
    function __contruct()
    {
        $this->middleware('permission:ver-usuario | crear-usuario | editar-usuario | borrar-usuario', ['only'=>['index']]);
        $this->middleware('permission:crear-usuario', ['only'=>['create','store']]);
        $this->middleware('permission:editar-usuario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-usuario',['only'=>['destroy']]);


    }
    
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        
        //Si es delegado le va salir todo lo de su delegacion de todos los roles
        if($userRole[0] == "Notificador"){
            $estadisticas = SeerNotificadores::where('delegacion', $user["delegacion"])->get();
        }
        //Si es otro usuario le va mostrar unicamente las del ese usuario
        else if($userRole[0] == "Auxiliar"){
            $estadisticas = SeerAuxiliares::where('user_id', $id)->get();
        }
        else if($userRole[0] == "Conciliador"){
            $estadisticas = SeerConciliadores::where('user_id', $id)->get();
        }
        else if($userRole[0] == "Delegado"){
            $estadisticas = SeerDelegados::where('user_id', $id)->get();
        }

        return view('estadisticas.index',compact('estadisticas','userRole'));
    }

    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();

   
        return view('estadisticas.crear', compact('user','userRole'));
    }

    public function store_notificador(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);

        //Validar documentacion
        request()->validate([
            'citatorios'                    => 'required|numeric',
            'asesorias_notificador'         => 'required|numeric',
            'solicitudes_levantadas'        => 'required|numeric',
            'ratificaciones_notificador'    => 'required|numeric',
            'multas_notificador'            => 'required|numeric',
            'informe_diario'                => 'required|numeric',
            'informe_foraneo'               => 'required|numeric',
            'integrar_expediente'           => 'required|numeric',
            'escaneo_documentos'            => 'required|numeric',
        ], $data);

        $data['user_id'] = $user["id"];
        $data['fecha'] = date('Y-m-d');
        $data['delegacion'] = $user["delegacion"];

        SeerNotificadores::create($data);  
        return redirect()->route('seer'); 
    }

    public function store_auxiliares(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);

        //Validar documentacion
        request()->validate([
            'solicitues_atendidas'          => 'required|numeric',
            'audiencia_programada'          => 'required|numeric',
            'audiencia_celebradas'          => 'required|numeric',
            'convenios_conciliatorios'      => 'required|numeric',
            'ratificaciones_convenio'       => 'required|numeric',
            'contancias_no conciliacion'    => 'required|numeric',
            'cuantificaciones'              => 'required|numeric',
            'asesorias'                     => 'required|numeric',
            'integracion_expediente'        => 'required|numeric',
            'colectivas'                    => 'required|numeric',
        ], $data);

        $data['user_id'] = $user["id"];
        $data['fecha'] = date('Y-m-d');
        $data['delegacion'] = $user["delegacion"];

        SeerAuxiliares::create($data);  
        return redirect()->route('seer'); 
    
    }

    public function store_conciliadores(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);

        //Validar documentacion
        request()->validate([
            'solicitues_atendidas'          => 'required|numeric',
            'audiencia_programada'          => 'required|numeric',
            'audiencia_celebradas'          => 'required|numeric',
            'convenios_conciliatorios'      => 'required|numeric',
            'ratificaciones_convenio'       => 'required|numeric',
            'contancias_no_conciliacion'    => 'required|numeric',
            'cuantificaciones'              => 'required|numeric',
            'asesorias'                     => 'required|numeric',
            'integracion_expediente'        => 'required|numeric',
            'colectivas'                    => 'required|numeric',
        ], $data);

        $data['user_id'] = $user["id"];
        $data['fecha'] = date('Y-m-d');
        $data['delegacion'] = $user["delegacion"];

        SeerConciliadores::create($data);  
        return redirect()->route('seer'); 
    
    }

    public function store_delegado(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);

        //Validar documentacion
        request()->validate([
            'personas_atendidas'                    => 'required|numeric',
            'asesorias'                             => 'required|numeric',
            'solicitudes_inicio'                    => 'required|numeric',
            'audiencias_programadas'                => 'required|numeric',
            'audiencias_celebradas'                 => 'required|numeric',
            'solicitudes_incopetencia'              => 'required|numeric',
            'convenio_audiencia'                    => 'required|numeric',
            'ratificacion_convenios'                => 'required|numeric',
            'monto_convenios'                       => 'required|numeric',
            'notificaciones'                        => 'required|numeric',
            'contancia_no_conciliacion'             => 'required|numeric',
            'contancia_no_conciliacion_patron'      => 'required|numeric',
            'contancia_no_conciliacion_notificacion'=> 'required|numeric',
            'solicitudes_archivadas'                => 'required|numeric',
            'colectivas'                            => 'required|numeric',
            'mujeres'                               => 'required|numeric',
            'hombres'                               => 'required|numeric',
            'despido_injitificado'                  => 'required|numeric',
            'finiquito'                             => 'required|numeric',
            'derecho_preferencia'                   => 'required|numeric',
            'pago_prestaciones'                     => 'required|numeric',
            'terminacion_volintaria'                => 'required|numeric',
            'supuesto_excepciones'                  => 'required|numeric',
            'otros'                                 => 'required|numeric',
            'multas'                                => 'required|numeric',
            'cincuenta_umas'                        => 'required|numeric',
            'cien_umas'                             => 'required|numeric',
            'otro_monto'                            => 'required|numeric',
        ], $data);

        $data['user_id'] = $user["id"];
        $data['fecha'] = date('Y-m-d');
        $data['delegacion'] = $user["delegacion"];

        SeerDelegados::create($data);  
        return redirect()->route('seer'); 
    
    }

    public function estadistica(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        
        $relacionEloquent = 'roles';
        $usuariosconciliador = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Conciliador');
        })->get();
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })->get();
        $usuariosnotificadores = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Notificador');
        })->get();

        //Listado de sedes
        $estadisticas = Sedes::pluck('nombre','id')->all();
        
        return view('estadisticas.estadistica', compact('user','userRole','estadisticas','usuariosconciliador','usuariosauxiliares','usuariosnotificadores'));
    }

    public function mostar(){

    }


    public function create_persona(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();

        $municipios = DB::table('municipios')
        ->join('estados_municipios', 'estados_municipios.id', '=', 'municipios.id')
        ->select('municipios.id', 'municipios.municipio')
        ->where('estados_municipios.estados_id', 16)
        ->get();
        
        return view('estadisticas.crear_persona', compact('user','userRole','municipios'));
    }
}
