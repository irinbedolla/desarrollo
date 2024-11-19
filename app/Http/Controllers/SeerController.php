<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\SeerAuxiliares;
use App\Models\SeerNotificadores;
use App\Models\SeerConciliadores;
use App\Models\SeerDelegados;
use App\Models\Municipios;
use App\Models\Estados;
use App\Models\SeerPerGeneral;
use App\Models\SeerPerAuxiliar;
use App\Models\SeerPerConciliador;
use App\Models\SeerColectivas;
use App\Models\SeerConvenios;

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
        $fecha_actual = date('y-m-d');
        
        //Si es delegado le va salir todo lo de su delegacion de todos los roles
        if($userRole[0] == "Notificador"){
            $estadisticas = SeerNotificadores::where('delegacion', $user["delegacion"])->get();
        }
        //Si es otro usuario le va mostrar unicamente las del ese usuario
        else if($userRole[0] == "Auxiliar"){
            $personas     = SeerPerGeneral::where('fecha', $fecha_actual)->where('user_id', $id)->get();
            $estadisticas = SeerAuxiliares::where('fecha', $fecha_actual)->where('user_id', $id)->first();
        }
        else if($userRole[0] == "Conciliador"){
            //solo le van aparecer solicitudes
            $personas     = SeerPerGeneral::where('fecha', $fecha_actual)->where('conciliador_id', $id)
            ->join('seer_auxiliares','seer_auxiliares.id_solicitud',"=",'seer_general.id')
            ->where('seer_auxiliares.tipo_solicitud','Solicitud')
            ->get();
            $estadisticas = SeerConciliadores::where('fecha', $fecha_actual)->where('user_id', $id)->first();
        }
        else if($userRole[0] == "Delegado"){
            $estadisticas = SeerDelegados::where('user_id', $id)->get();
        }

        return view('estadisticas.index',compact('estadisticas','userRole','personas'));
    }

    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');

        $suma_solicitudes = SeerPerGeneral::
        join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
        ->where("seer_auxiliares.tipo_solicitud","Solicitud")
        ->where('fecha',"=", $fecha_actual)
        ->where('user_id',"=", $id)
        ->selectRaw('count(seer_general.id) as total')
        ->first();

        $suma_ratificaciones = SeerPerGeneral::
        join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
        ->where("seer_auxiliares.tipo_solicitud","Ratificación")
        ->where('fecha',"=", $fecha_actual)
        ->where('user_id',"=", $id)
        ->selectRaw('count(seer_general.id) as total')
        ->first();

        $total = SeerPerGeneral::
            join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
            ->where("seer_auxiliares.tipo_solicitud","Ratificación")
            ->where('fecha',"=", $fecha_actual)
            ->where('user_id',"=", $id)
            ->selectRaw('SUM(seer_auxiliares.monto) as monto')
            ->first();

        return view('estadisticas.crearConsentradoAux', compact('user','userRole','suma_solicitudes','suma_ratificaciones','total'));
    }
    
    public function ver_consentrado_aux(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');

        $estadisticas  = SeerAuxiliares::where('user_id',$id)
        ->where('fecha',$fecha_actual)
        ->first();

        return view('estadisticas.crearConsentradoVer', compact('estadisticas','userRole'));
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
            'solicitudes'           => 'required|numeric',
            'ratificaciones'        => 'required|numeric',
            'asesorias'             => 'required|numeric',
            'expediente_consulta'   => 'required|numeric',
            'expediente_escaneo'    => 'required|numeric',
            'expediente_foliar'     => 'required|numeric',
            'cuantificacion'        => 'required|numeric',
            'exhortos'              => 'required|numeric',
            'audiencias_celebradas' => 'required|numeric',
            'cumplimientos'         => 'required|numeric',
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
        })
        ->where('delegacion', $user["delegacion"])
        ->get();
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();
        $usuariosnotificadores = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Notificador');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        $estados = Estados::all();
        $municipios = Municipios::all();

        //Listado de sedes
        $estadisticas = Sedes::pluck('nombre','id')->all();
        
        return view('estadisticas.estadistica', compact('user','userRole','estadisticas','usuariosconciliador','usuariosauxiliares','usuariosnotificadores','estados','municipios'));
    }

    public function mostrar_reporte(Request $request){
        $data = $request->all();

        //Primero vamos a validar si el reporte sera cuanticativo o detallado
        //Validar documentacion
        request()->validate([
            //General
            'fecha_inicial' => 'required|date',
            'fecha_final'   => 'required|date',
            'tipo_reporte'  => 'required|in:Cuantificaciones,Detallado',

        ], $data);

        if(isset($data["sede"]))
            $sede = $data["sede"];
        else
            $sede = "";
        if(isset($data["conciliador"]))
            $conciliador = $data["conciliador"];
        else
            $conciliador = "";
        if(isset($data["auxiliar"]))
            $auxiliar = $data["auxiliar"];
        else
            $auxiliar = "";
        if(isset($data["notificador"]))
            $notificador = $data["notificador"];
        else
            $notificador = "";
        if(isset($data["tipo_audiencia"]))
            $tipo_audiencia = $data["tipo_audiencia"];
        else
            $tipo_audiencia = "";
        if(isset($data["sexo"]))
            $sexo = $data["sexo"];
        else
            $sexo = "";
        if(isset($data["tipo_solicitud"]))
            $tipo_solicitud = $data["tipo_solicitud"];
        else
            $tipo_solicitud = "";
        if(isset($data["estado_solicitante"]))
            $estado_solicitante = $data["estado_solicitante"];
        else
            $estado_solicitante = "";
        if(isset($data["mun_solicitante"]))
            $mun_solicitante = $data["mun_solicitante"];
        else
            $mun_solicitante = "";
        if(isset($data["centro"]))
            $centro = $data["centro"];
        else
            $centro = "";
        if(isset($data["motivo"]))
            $motivo = $data["motivo"];
        else
            $motivo = "";
        if(isset($data["estatus"]))
            $estatus = $data["estatus"];
        else
            $estatus = "";
        if(isset($data["tipo_persona"]))
            $tipo_persona = $data["tipo_persona"];
        else
            $tipo_persona = "";
            
        //Primeramente reporte detallado
        if($data["tipo_reporte"] == "Detallado"){
            //No se selecciono nada y va buscar todo de fecha a otra
            if($sede == "" && $conciliador == "" && $auxiliar == "" && $notificador == "" && $tipo_audiencia == "" 
            && $sexo == "" && $tipo_solicitud == "" && $estado_solicitante == "" && $mun_solicitante == ""){
                $solicitudes  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id")
                ->join("estados","estados.id","=","seer_general.estado_solicitante")
                ->join("municipios","municipios.id","=","seer_general.mun_solicitante")
                ->join("users","users.id","=","seer_general.user_id")
                ->select("seer_general.id","seer_general.fecha","seer_general.NUE","seer_general.solicitante","seer_auxiliares.actividad_economica",
                "estados.nombre as estado","municipios.nombre as municipio","seer_general.citado","seer_auxiliares.sexo","seer_auxiliares.tipo_persona","seer_auxiliares.motivo",
                "seer_auxiliares.notificacion","users.name as usuario")
                ->where("seer_auxiliares.tipo_solicitud", "Solicitud")
                ->get();

                $ratificaciones  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id")
                ->join("estados","estados.id","=","seer_general.estado_solicitante")
                ->join("municipios","municipios.id","=","seer_general.mun_solicitante")
                ->join("users","users.id","=","seer_general.user_id")
                ->select("seer_general.id","seer_general.fecha","seer_general.NUE","seer_general.solicitante","seer_auxiliares.actividad_economica",
                "estados.nombre as estado","municipios.nombre as municipio","seer_general.citado","seer_auxiliares.sexo","seer_auxiliares.tipo_persona","seer_auxiliares.motivo",
                "seer_auxiliares.monto","seer_auxiliares.estatus","users.name as usuario")
                ->where("seer_auxiliares.tipo_solicitud", "Ratificación")
                ->get();
            

                $audiencia  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id")
                ->join("seer_conciliadores","seer_conciliadores.id_solicitud","=","seer_general.id")
                ->join("estados","estados.id","=","seer_general.estado_solicitante")
                ->join("municipios","municipios.id","=","seer_general.mun_solicitante")
                ->join("users","users.id","=","seer_general.user_id")
                ->select("seer_general.id","seer_general.fecha","seer_general.NUE","seer_general.solicitante","seer_general.citado","seer_auxiliares.actividad_economica",
                "seer_conciliadores.numero_audiencia","seer_conciliadores.estatus_conciliacion","seer_conciliadores.monto","seer_conciliadores.cumplimiento_pago",
                "seer_conciliadores.observaciones","seer_conciliadores.multa","seer_conciliadores.tipo",
                "estados.nombre as estado","municipios.nombre as municipio","users.name as usuario")
                ->where("seer_auxiliares.tipo_solicitud", "Solicitud")
                ->get();

                $colectivas = SeerColectivas::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("users","users.id","=","seer_colectivas.conciliador")
                ->select("seer_colectivas.*","users.name as usuario")
                ->get();

                $convenios = SeerConvenios::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("users","users.id","=","seer_convenios.conciliador")
                ->select("seer_convenios.*","users.name as usuario")
                ->get();
            }

            return view('estadisticas.ver_reporte', compact('solicitudes','ratificaciones','audiencia','colectivas','convenios'));
        }
        else if($data["tipo_reporte"] == "Cuantificaciones"){
            $solicitudes  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"]);
            $solicitudes = $solicitudes->where("fecha","<=",$data["fecha_final"]);
            $solicitudes = $solicitudes->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id");
            if($sede != ""){
                $solicitudes = $solicitudes->where("seer_general.delegacion", $sede);
            }
            if($tipo_persona != ""){
                $solicitudes = $solicitudes->where("seer_auxiliares.tipo_persona", $tipo_persona);
            }
            if($motivo != ""){
                $solicitudes = $solicitudes->where("seer_auxiliares.motivo", $motivo);
            }
            if($estatus != ""){
                $solicitudes = $solicitudes->where("seer_auxiliares.estatus", $estatus);
            }
            if($centro != ""){
                $solicitudes = $solicitudes->where("seer_auxiliares.notificacion", $centro);
            }
            if($auxiliar != ""){
                $solicitudes = $solicitudes->where("seer_general.user_id", $auxiliar);
            }
            if($notificador != ""){
                $solicitudes = $solicitudes->where("seer_general.user_id", $notificador);
            }
            if($sexo != ""){
                $solicitudes = $solicitudes->where("seer_auxiliares.sexo", $sexo);
            }
            if($tipo_solicitud != ""){
            $solicitudes = $solicitudes->where("seer_auxiliares.tipo_solicitud", $tipo_solicitud);
            }
            if($estado_solicitante != ""){
                $solicitudes = $solicitudes->where("seer_general.estado_solicitante", $estado_solicitante);
            }
            if($mun_solicitante != ""){
                $solicitudes = $solicitudes->where("seer_general.mun_solicitante", $mun_solicitante);
            }
            $solicitudes = $solicitudes->where("seer_auxiliares.tipo_solicitud", "Solicitud")
            ->selectRaw('count(seer_general.id) as solicitudes')
            ->first();

            $ratificaciones  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"]);
            $ratificaciones  = $ratificaciones->where("fecha","<=",$data["fecha_final"]);
            $ratificaciones  = $ratificaciones->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id");
            if($sede != ""){
                $ratificaciones = $ratificaciones->where("seer_general.delegacion", $sede);
            }
            if($conciliador != ""){
                $ratificaciones = $ratificaciones->where("seer_general.conciliador_id", $conciliador);
            }
            /*
            if($auxiliar != ""){
                $ratificaciones = $ratificaciones->where("seer_general.user_id", $auxiliar);
            }
            if($notificador != ""){
                $ratificaciones = $ratificaciones->where("seer_general.user_id", $notificador);
            }
            */
            if($sexo != ""){
                $ratificaciones = $ratificaciones->where("seer_auxiliares.sexo", $sexo);
            }
            /*
            if($tipo_solicitud != ""){
                $ratificaciones = $ratificaciones->where("seer_auxiliares.tipo_solicitud", $tipo_solicitud);
            }
            */
            if($estado_solicitante != ""){
                $ratificaciones = $ratificaciones->where("seer_general.estado_solicitante", $estado_solicitante);
            }
            if($mun_solicitante != ""){
                $ratificaciones = $ratificaciones->where("seer_general.mun_solicitante", $mun_solicitante);
            }
            $ratificaciones  = $ratificaciones->where("seer_auxiliares.tipo_solicitud", "Ratificación");
            $ratificaciones  = $ratificaciones->selectRaw('count(seer_general.id) as ratificaciones')
            ->first();

            $montoratificaciones  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"]);
            $montoratificaciones = $montoratificaciones->where("fecha","<=",$data["fecha_final"]);
            $montoratificaciones = $montoratificaciones->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id");
            if($sede != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.delegacion", $sede);
            }
            /*
            if($conciliador != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.conciliador_id", $conciliador);
            }
            */
            if($auxiliar != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.user_id", $auxiliar);
            }
            if($notificador != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.user_id", $notificador);
            }
            if($sexo != ""){
                $montoratificaciones = $montoratificaciones->where("seer_auxiliares.sexo", $sexo);
            }
            /*
            if($tipo_solicitud != ""){
                $montoratificaciones = $montoratificaciones->where("seer_auxiliares.tipo_solicitud", $tipo_solicitud);
            }
            */
            if($estado_solicitante != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.estado_solicitante", $estado_solicitante);
            }
            if($mun_solicitante != ""){
                $montoratificaciones = $montoratificaciones->where("seer_general.mun_solicitante", $mun_solicitante);
            }
            $montoratificaciones = $montoratificaciones->where("seer_auxiliares.tipo_solicitud", "Ratificación");
            $montoratificaciones = $montoratificaciones->selectRaw('sum(seer_auxiliares.monto) as ratificaciones')
            ->first();
            
            $audiencia  = SeerPerGeneral::where("fecha",">=",$data["fecha_inicial"]);
            $audiencia  = $audiencia->where("fecha","<=",$data["fecha_final"]);
            $audiencia  = $audiencia->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id");
            $audiencia  = $audiencia->join("seer_conciliadores","seer_conciliadores.id_solicitud","=","seer_general.id");
            if($sede != ""){
                $audiencia = $audiencia->where("seer_general.delegacion", $sede);
            }
            if($conciliador != ""){
                $audiencia = $audiencia->where("seer_general.conciliador_id", $conciliador);
            }
            /*
            if($auxiliar != ""){
                $audiencia = $audiencia->where("seer_general.user_id", $auxiliar);
            }
            */
            if($tipo_audiencia != ""){
                $audiencia = $audiencia->where("seer_conciliadores.estatus_conciliacion", $tipo_audiencia);
            }
            if($sexo != ""){
                $audiencia = $audiencia->where("seer_auxiliares.sexo", $sexo);
            }
            if($estado_solicitante != ""){
                $audiencia = $audiencia->where("seer_general.estado_solicitante", $estado_solicitante);
            }
            if($mun_solicitante != ""){
                $audiencia = $audiencia->where("seer_general.mun_solicitante", $mun_solicitante);
            }
            $audiencia  = $audiencia->where("seer_auxiliares.tipo_solicitud", "Solicitud");
            $audiencia  = $audiencia->selectRaw('count(seer_general.id) as audiencia')
            ->first();

                $montoaudiencia  = SeerPerGeneral::
                where("fecha",">=",$data["fecha_inicial"])
                ->where("fecha","<=",$data["fecha_final"])
                ->join("seer_auxiliares","seer_auxiliares.id_solicitud","=","seer_general.id")
                ->join("seer_conciliadores","seer_conciliadores.id_solicitud","=","seer_general.id")
                ->where("seer_auxiliares.tipo_solicitud", "Solicitud")
                ->selectRaw('sum(seer_conciliadores.monto) as audiencia')
                ->first();

                $colectivas = SeerColectivas::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("users","users.id","=","seer_colectivas.conciliador")
                ->selectRaw('count(seer_colectivas.id) as colectivas')
                ->first();

                $convenios = SeerConvenios::where("fecha",">=",$data["fecha_inicial"])->where("fecha","<=",$data["fecha_final"])
                ->join("users","users.id","=","seer_convenios.conciliador")
                ->selectRaw('count(seer_convenios.id) as convenios')
                ->first();

                return view('estadisticas.ver_reporte_cuantitativo', compact('solicitudes','ratificaciones','montoratificaciones','audiencia','montoaudiencia','colectivas','convenios'));
        }
        
    }

    public function create_persona_s(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $estados = Estados::all();
        $relacionEloquent = 'roles';

        $conciliadores = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Conciliador');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        return view('estadisticas.crearPersonaAux', compact('user','userRole', 'estados','conciliadores'));
    }

    public function create_persona_r(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $estados = Estados::all();
        $relacionEloquent = 'roles';

        $conciliadores = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Conciliador');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        return view('estadisticas.crearPersonaAuxR', compact('user','userRole', 'estados','conciliadores'));
    }

    public function obtenerMunicipio($id){
        return Municipios::where('estado', $id)->get();
    }

    public function auxiliar_persona(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('y-m-d');

        //Validar documentacion
        request()->validate([
            //General
            'NUE'                   => 'required|min:18|max:18',
            'solicitante'           => 'required',
            'estado_solicitante'    => 'required|numeric',
            'mun_solicitante'       => 'required|numeric',
            'actividad_economica'   => 'required',
            'citado'                => 'required',
            'estado_citado'         => 'required|numeric',
            'municipio_citado'      => 'required|numeric',
            'conciliador_id'        => 'required|numeric',

            //Auxiliares
            'sexo'                  => 'required|in:H,M',
            'tipo_persona'          => 'required|in:Moral,Fisica',
            'motivo'                => 'required|in:Despido,Pago de prestaciones,Recision de la relación laboral,Derecho de preferencia,Derecho de antiguedad,Derecho de ascesnso,Terminación voluntaria de relación laboral',
            'notificacion'          => 'required|in:Trabajador,Centro,Ambos',

        ], $data);

        $data_general = [
            'fecha'                 => $fecha_actual,
            'NUE'                   => $data["NUE"],
            'solicitante'           => $data["solicitante"],
            'estado_solicitante'    => $data["estado_solicitante"],
            'mun_solicitante'       => $data["mun_solicitante"],
            'citado'                => $data["citado"],
            'estado_citado'         => $data["estado_citado"],
            'mun_citado'            => $data["municipio_citado"],
            'user_id'               => $id,
            'conciliador_id'        => $data["conciliador_id"],
            'delegacion'            => $user["delegacion"],
        ];

        SeerPerGeneral::create($data_general);  
        $id_general  = SeerPerGeneral::latest('id')->first();

        $data_auxiliar = [
            'id_solicitud'              => $id_general["id"],
            'sexo'                      => $data["sexo"],
            'tipo_persona'              => $data["tipo_persona"],
            'actividad_economica'       => $data["actividad_economica"],
            'motivo'                    => $data["motivo"],
            'notificacion'              => $data["notificacion"],
            'tipo_solicitud'            => "Solicitud",
        ];
        SeerPerAuxiliar::create($data_auxiliar);  

        return redirect()->route('seer');
    }

    public function auxiliar_personar(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('y-m-d');

        //Validar documentacion
        request()->validate([
            //General
            'NUE'                   => 'required|min:18|max:18',
            'solicitante'           => 'required',
            'estado_solicitante'    => 'required|numeric',
            'mun_solicitante'       => 'required|numeric',
            'actividad_economica'   => 'required',
            'citado'                => 'required',
            'estado_citado'         => 'required|numeric',
            'municipio_citado'      => 'required|numeric',
            'conciliador_id'        => 'required|numeric',

            //Auxiliares
            'sexo'                  => 'required|in:H,M',
            'tipo_persona'          => 'required|in:Moral,Fisica',
            'motivo'                => 'required|in:Despido,Pago de prestaciones,Recision de la relación laboral,Derecho de preferencia,Derecho de antiguedad,Derecho de ascesnso,Terminación voluntaria de relación laboral',
            'notificacion'          => 'required|in:Trabajador,Centro,Ambos',
            'monto'                 => 'required|numeric',
            'estatus'               => 'required|in:Pendiente,Parcial,Cumplido',
        ], $data);

        $data_general = [
            'fecha'                 => $fecha_actual,
            'NUE'                   => $data["NUE"],
            'solicitante'           => $data["solicitante"],
            'estado_solicitante'    => $data["estado_solicitante"],
            'mun_solicitante'       => $data["mun_solicitante"],
            'citado'                => $data["citado"],
            'estado_citado'         => $data["estado_citado"],
            'mun_citado'            => $data["municipio_citado"],
            'user_id'               => $id,
            'conciliador_id'        => $data["conciliador_id"],
            'delegacion'            => $user["delegacion"],
        ];

        SeerPerGeneral::create($data_general);  
        $id_general  = SeerPerGeneral::latest('id')->first();

        $data_auxiliar = [
            'id_solicitud'              => $id_general["id"],
            'sexo'                      => $data["sexo"],
            'tipo_persona'              => $data["tipo_persona"],
            'actividad_economica'       => $data["actividad_economica"],
            'motivo'                    => $data["motivo"],
            'notificacion'              => $data["notificacion"],
            'monto'                     => $data["monto"],
            'estatus'                   => $data["estatus"],
            'tipo_solicitud'            => "Ratificación",
        ];
        SeerPerAuxiliar::create($data_auxiliar);  

        return redirect()->route('seer');
    }

    public function ver_auxiliar($id){
        $id_usuario = auth()->user()->id;
        $user = User::find($id_usuario);
        $userRole = $user->roles->pluck('name')->all();

        $general  = SeerPerGeneral::find($id);
        $auxiliar = SeerPerAuxiliar::where("id_solicitud",$id)->first();
        
        $estado_citado = Estados::find($general["estado_solicitante"]);
        $mun_citado    = Municipios::find($general["mun_solicitante"]);

        $estado_solicitante = Estados::find($general["estado_citado"]);
        $mun_solicitante    = Municipios::find($general["mun_citado"]);

        $conciliador    = User::find($general["conciliador_id"]);
        

        return view('estadisticas.verPersonaAux', compact('userRole','general','auxiliar','estado_citado','mun_citado','estado_solicitante','mun_solicitante','conciliador'));
    }

    public function conciliador_persona(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('y-m-d');

        //Validar documentacion
        request()->validate([
            'id'                    => 'required|numeric',
            'citado'                => 'required',
            'actividad_economica'   => 'required',
            'numero_audiencia'      => 'required',
            'estatus'               => 'required|in:Conciliacion,No conciliacion,Incompetencia,Regenerada,Archivado por incomparecencia',
            'monto'                 => 'required|numeric',
            'multa'                 => 'required|in:Si,No',
            'solicitud'             => 'required|in:Presencial,Linea',
        ], $data);


        $data_general = SeerPerGeneral::
        where('id', $data["id"])
        //->update(['citado' => $data["citado"]])
        ->update(['validado_conciliador' => "Guardado"]);
          
        $data_general = SeerPerAuxiliar::
        where('id_solicitud', $data["id"])
        ->update(['actividad_economica' => $data["actividad_economica"]]);


        $data_conciliador = [
            'id_solicitud'          => $data["id"],
            'numero_audiencia'      => $data["numero_audiencia"],
            'estatus_conciliacion'  => $data["estatus"],
            'monto'                 => $data["monto"],
            'cumplimiento_pago'     => $data["cumplimiento"],
            'observaciones'         => $data["observacion"],
            'multa'                 => $data["multa"],
            'tipo'                  => $data["solicitud"],
            'validado'              => 'Validado',
        ];
        SeerPerConciliador::create($data_conciliador);  

        return redirect()->route('seer');
    }
  
    public function crear_audiencia($id){
        $id_usuario = auth()->user()->id;
        $user = User::find($id_usuario);
        $userRole = $user->roles->pluck('name')->all();

        $general  = SeerPerGeneral::find($id);
        $auxiliar = SeerPerAuxiliar::where("id_solicitud",$id)->first();
        
        $estado_citado = Estados::find($general["estado_solicitante"]);
        $mun_citado    = Municipios::find($general["mun_solicitante"]);

        $estado_solicitante = Estados::find($general["estado_citado"]);
        $mun_solicitante    = Municipios::find($general["mun_citado"]);

        $conciliador    = User::find($general["conciliador_id"]);
        
        return view('estadisticas.crearPersonaCon', compact('userRole','general','auxiliar','estado_citado','mun_citado','estado_solicitante','mun_solicitante','conciliador'));
    }

    public function ver_conciliador($id){
        $id_usuario = auth()->user()->id;
        $user = User::find($id_usuario);
        $userRole = $user->roles->pluck('name')->all();

        $general  = SeerPerGeneral::find($id);
        $auxiliar = SeerPerAuxiliar::where("id_solicitud",$id)->first();
        
        $estado_citado = Estados::find($general["estado_solicitante"]);
        $mun_citado    = Municipios::find($general["mun_solicitante"]);

        $estado_solicitante = Estados::find($general["estado_citado"]);
        $mun_solicitante    = Municipios::find($general["mun_citado"]);

        $conciliador = SeerPerConciliador::where("id_solicitud",$id)->first();

        return view('estadisticas.verPersonaCon', compact('userRole','general','auxiliar','estado_citado','mun_citado','estado_solicitante','mun_solicitante','conciliador'));
    }

    public function index_convenios(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');
        
       
        //solo le van aparecer solicitudes
        $convenios = SeerConvenios::where('fecha', $fecha_actual)->where('conciliador', $id)->get();

        return view('estadisticas.index_convenios',compact('convenios','userRole'));
    }
    
    public function crear_convenio(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');
        
       
        //solo le van aparecer solicitudes
        $convenios = SeerConvenios::where('fecha', $fecha_actual)->where('conciliador', $id)->get();

        return view('estadisticas.crear_convenio',compact('convenios','userRole'));
    }

    public function store_convenio(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('y-m-d');

        //Validar documentacion
        request()->validate([
            'fecha'         => 'required|date',
            'NUE'           => 'required|min:18|max:18',
            'solicitante'   => 'required',
            'citado'        => 'required',
            'monto'         => 'required|numeric',
            'tipo_pago'     => 'required',
            'solicitud'     => 'required|in:Concluido,Parcialidades,Incumplimiento',
        ], $data);
        $data['conciliador'] = $id;

        SeerConvenios::create($data);  

        return redirect()->route('index_convenios');
    }

    public function index_colectivas(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');
        
       
        //solo le van aparecer solicitudes
        $convenios = SeerColectivas::where('fecha', $fecha_actual)->where('conciliador', $id)->get();

        return view('estadisticas.index_colectivas',compact('convenios','userRole'));
    }

    public function crear_colectiva(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');
        
       
        //solo le van aparecer solicitudes
        //$convenios = SeerConvenios::where('fecha', $fecha_actual)->where('conciliador', $id)->get();

        return view('estadisticas.crear_colectiva',compact('userRole'));
    }

    public function store_colectiva(Request $request){
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('y-m-d');

        //Validar documentacion
        request()->validate([
            'fecha'         => 'required|date',
            'NUE'           => 'required|min:18|max:18',
            'solicitante'   => 'required',
            'citado'        => 'required',
            'juzgado'       => 'required',
            'estado'        => 'required',
        ], $data);
        $data['conciliador'] = $id;

        SeerColectivas::create($data);  

        return redirect()->route('index_colectivas');
    }

    public function create_conciliador(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();
        $fecha_actual = date('y-m-d');

        $suma_solicitudes = SeerPerGeneral::
        join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
        ->where("seer_auxiliares.tipo_solicitud","Solicitud")
        ->where('fecha',"=", $fecha_actual)
        ->where('user_id',"=", $id)
        ->selectRaw('count(seer_general.id) as total')
        ->first();

        $suma_ratificaciones = SeerPerGeneral::
        join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
        ->where("seer_auxiliares.tipo_solicitud","Ratificación")
        ->where('fecha',"=", $fecha_actual)
        ->where('user_id',"=", $id)
        ->selectRaw('count(seer_general.id) as total')
        ->first();

        $total = SeerPerGeneral::
            join("seer_auxiliares","seer_auxiliares.id_solicitud", "=" , "seer_general.id")
            ->where("seer_auxiliares.tipo_solicitud","Ratificación")
            ->where('fecha',"=", $fecha_actual)
            ->where('user_id',"=", $id)
            ->selectRaw('SUM(seer_auxiliares.monto) as monto')
            ->first();

        return view('estadisticas.crearConsentradoCon', compact('user','userRole','suma_solicitudes','suma_ratificaciones','total'));
    }
}
