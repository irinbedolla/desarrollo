<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turnos;
use App\Models\TurnoDisponible;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class TurnosController extends Controller
{
    function __contruct()
    {
        $this->middleware('permission:ver-usuario | crear-usuario | editar-usuario | borrar-usuario', ['only'=>['index']]);
        $this->middleware('permission:crear-usuario', ['only'=>['create','store']]);
        $this->middleware('permission:editar-usuario',['only'=>['edit','update']]);
        $this->middleware('permission:borrar-usuario',['only'=>['destroy']]);
    }
    
    public function index()
    {
        $fecha_actual = date('Y-m-d');
        $relacionEloquent = 'roles';
        $id = auth()->user()->id;
        $user = User::find($id);


        $auxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        $auxiliares_morelia = array();
        foreach($auxiliares as $auxiliar){
            $estatus = "Disponible";
            $ocupados = TurnoDisponible::where('fecha', $fecha_actual)
            ->where('id_auxiliar', $auxiliar["id"])
            ->select('turno_disponible.estatus')
            ->orderBy('id', 'DESC')
            ->get();

            if(!count($ocupados) == 0){
                $estatus = $ocupados[0]["estatus"];
            }
            $data_insertar = [
                'id'        => $auxiliar["id"],
                'name'      => $auxiliar["name"],
                'delegacion'=> $auxiliar["delegacion"],
                'estatus'   => $estatus,
            ];
            array_push($auxiliares_morelia, $data_insertar);
        }
        $total = count($auxiliares_morelia);

        return view('turnos.index',compact('auxiliares_morelia','total'));
    }

    public function create()
    {
        //Vamos a traer un usuario para asignarle los roles
        $id_usuario = Auth::id();
        return view('turnos.crear', compact('id_usuario'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $id = auth()->user()->id;
        $user = User::find($id);

        request()->validate([
            'nombre' => 'required',
            'tipo' => 'required',
        ], $data);

        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");
        $numero_consecutivo = 0;
        $consecutivo  = Turnos::latest('id')
        ->where('fecha', $fecha_actual)
        ->first();
        $ocupados     = TurnoDisponible::where('fecha', $fecha_actual)->where('estatus', 'Ocupado')->get();

        if(empty($consecutivo)){
            $numero_consecutivo = 1;
        }
        else{
            $numero_consecutivo = $consecutivo["consecutivo"];
            $numero_consecutivo++;
        }
        
        ///////Vamos a validar si es excepcion se va cambiar el rol///////
        //Si existe caso de expecion
        if(isset($data["caso"])){
            $relacionEloquent = 'roles';
            $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
                return $query->where('name', '=', 'Excepcion');
            })
            ->where('delegacion', $user["delegacion"])
            ->get();

            $data_insertar= array(
                'consecutivo'   => $numero_consecutivo,
                'solicitante'   => $data["nombre"],
                'auxiliar'      => $usuariosauxiliares[0]["id"],
                'lugar_auxiliar'=> "Departamento de Igualdad de Género",
                'tipo'          => $data["tipo"],
                'fecha'         => $fecha_actual,
                'hora'          => $hora_actual,
                'delegacion'    => $user["delegacion"],
                'estatus'       => "no atendido",
                'exepcion'      => "Si",
                'edad'          => $data["edad"],
                'sexo'          => $data["sexo"],
                'conflicto'     => $data["conflicto"]

            );
            
            $data_insertar_disponible= array(
                'id_auxiliar'   => $usuariosauxiliares[0]["id"],
                'fecha'         => $fecha_actual,
                'hora'          => $hora_actual,
                'estatus'       => 'Ocupado'
            );

            TurnoDisponible::create($data_insertar_disponible);
            Turnos::create($data_insertar);
        }
        ///// Si no es caso de exepcion ////////////////
        else{
            $relacionEloquent = 'roles';
            $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
                return $query->where('name', '=', 'Auxiliar');
            })
            ->where('delegacion', $user["delegacion"])
            ->get();

            $listado_ocupados = array();
            $listado_auxiliares = array(); 

            //Voy a leer los usuario que tengan estatus ocupado
            foreach($ocupados as $token ){
                array_push($listado_ocupados, $token["id_auxiliar"]);
            }

            foreach($usuariosauxiliares as $token ){
                //Validar que solo sea morelia
                //if($token["delegacion"] == "Morelia"){
                    //Si la lista no esta vacia
                    if(!empty($listado_ocupados)){
                        //Buscamos si existen auxiliares libres
                        if(in_array($token["id"], $listado_ocupados)){
                        }
                        else{
                            //if validar si es ratificaccion
                            if($data["tipo"] == "Ratificación"){
                                //Validar si random es diferente de 3-5-7
                                if($token["id"] == 3 || $token["id"] == 5 || $token["id"] ==7 ){
                                }
                                else{
                                    array_push($listado_auxiliares, $token["id"]);    
                                }
                            }else{
                                array_push($listado_auxiliares, $token["id"]);
                            }
                        }
                    }
                    //Si la lista es vacia agregamos a todos los auxiliares
                    else{
                        if($data["tipo"] == "Ratificación"){
                            //Validar si random es diferente de 3-5-7
                            if($token["id"] == 3 || $token["id"] == 5 || $token["id"] ==7 ){
                            }
                            else{
                                array_push($listado_auxiliares, $token["id"]);
                            }
                        }else{
                            array_push($listado_auxiliares, $token["id"]);
                        }
                    }
                //}
            }

            //validar si hay disponibles
            if(isset($listado_auxiliares) && count($listado_auxiliares) > 0 ){
                $random = array_rand($listado_auxiliares);
                
                //Relacion auxiliar con usuario
                switch($listado_auxiliares[$random]){
                    case 6: 
                        //Erandi
                        $lugar_auxiliar = "Auxiliar 1";
                        break;
                    case 10: 
                        //Rosario
                        $lugar_auxiliar = "Auxiliar 2";
                        break;
                    case 8: 
                        //Mayra
                        $lugar_auxiliar = "Auxiliar 3";
                        break;
                    case 9: 
                        //Luis
                        $lugar_auxiliar = "Auxiliar 4";
                        break;
                    case 3: 
                        //Yessiu
                        $lugar_auxiliar = "Auxiliar 5";
                        break;
                    case 7: 
                        //Clever
                        $lugar_auxiliar = "Auxiliar 6";
                        break;
                    case 5: 
                        //Sandra
                        $lugar_auxiliar = "Auxiliar 7";
                        break;
                    default:
                        $lugar_auxiliar = "Pendiente";
                        break;
                }

                $data_insertar= array(
                    'consecutivo'   => $numero_consecutivo,
                    'solicitante'   => $data["nombre"],
                    'auxiliar'      => $listado_auxiliares[$random],
                    'lugar_auxiliar'=> $lugar_auxiliar,
                    'tipo'          => $data["tipo"],
                    'fecha'         => $fecha_actual,
                    'hora'          => $hora_actual,
                    'delegacion'    => $user["delegacion"],
                    'estatus'       => 'no atendido'
                );

                Turnos::create($data_insertar);
                //Validar si tiene estatus disponible para insertar o actualizar
                $validar_estatus = TurnoDisponible::where('fecha', $fecha_actual)
                ->where('id_auxiliar', $listado_auxiliares[$random])
                ->select('turno_disponible.estatus')
                ->get();
                
                if(count($validar_estatus) == 0){
                    $data_insertar_disponible= array(
                        'id_auxiliar'   => $listado_auxiliares[$random],
                        'fecha'         => $fecha_actual,
                        'hora'          => $hora_actual,
                        'estatus'       => 'Ocupado'
                    );
                    
                    TurnoDisponible::create($data_insertar_disponible);
                }
                else{
                    $data_update = DB::table('turno_disponible')
                    ->where('id_auxiliar', $listado_auxiliares[$random])
                    ->update(['estatus' => 'Ocupado']);
                }
                
            }
            //Si no hay disponibles se va agregar turno con el auxiliar en 0 que es en espera 
            else{
                $data_insertar= array(
                    'consecutivo'   => $numero_consecutivo,
                    'solicitante'   => $data["nombre"],
                    'auxiliar'      => 0,
                    'lugar_auxiliar'=> "Pendiente",
                    'tipo'          => $data["tipo"],
                    'fecha'         => $fecha_actual,
                    'hora'          => $hora_actual,
                    'delegacion'    => $user["delegacion"],
                    'estatus'       => 'no atendido'
                );
                Turnos::create($data_insertar);
            }
        }
        return redirect()->route('turnos');
    }

    public function activo($id)
    {
        $fecha_actual = date('Y-m-d');

        $ocupados = TurnoDisponible::where('fecha', $fecha_actual)
        ->where('id_auxiliar', $id)
        ->get();

        //Si existe voy actualizar
        if(!count($ocupados) == 0){
            $data_update = DB::table('turno_disponible')
            ->where('id_auxiliar', $id)
            ->update(['estatus' => 'Disponible']);
            if($id == 3 || $id == 5 || $id ==7 ){
                $ocupados = Turnos::where('fecha', $fecha_actual)
                ->where('auxiliar', 0)
                ->where('tipo', 'Solicitud')
                ->orderBy('id', 'asc')
                ->first();
                //Si hay fila se va asiganar el primero de la fila al axulilar librre
                if(!empty($ocupados)){
                    $id_turno = $ocupados["id"];

                    //Relacion auxiliar con usuario
                    switch($IDauxiliar){
                        case 6: 
                            //Erandi
                            $lugar_auxiliar = "Auxiliar 1";
                            break;
                        case 10: 
                            //Rosario
                            $lugar_auxiliar = "Auxiliar 2";
                            break;
                        case 8: 
                            //Mayra
                            $lugar_auxiliar = "Auxiliar 3";
                            break;
                        case 9: 
                            //Luis
                            $lugar_auxiliar = "Auxiliar 4";
                            break;
                        case 3: 
                            //Yessiu
                            $lugar_auxiliar = "Auxiliar 5";
                            break;
                        case 7: 
                            //Clever
                            $lugar_auxiliar = "Auxiliar 6";
                            break;
                        case 5: 
                            //Sandra
                            $lugar_auxiliar = "Auxiliar 7";
                            break;
                        default:
                            $lugar_auxiliar = "Pendiente";
                            break;
                    }
                    
                    $turno_update= array(
                        'auxiliar'       => $IDauxiliar,
                        'lugar_auxiliar' => $lugar_auxiliar
                    );
                    $disponible_update= array(
                        'estatus'       => 'Ocupado'
                    );

                    $turno = Turnos::find($id_turno);
                    $turno->update($turno_update);

                    $persona = DB::table('turno_disponible')
                    ->where('id_auxiliar', $IDauxiliar)
                    ->where('fecha', $fecha_actual)
                    ->update(['estatus' => 'Ocupado']);
                }
            }
            else{
                $ocupados = Turnos::where('fecha', $fecha_actual)
                ->where('auxiliar', 0)
                ->orderBy('id', 'asc')
                ->first();
                //Si hay fila se va asiganar el primero de la fila al axulilar librre
                if(!empty($ocupados)){
                    $id_turno = $ocupados["id"];

                    //Relacion auxiliar con usuario
                    switch($IDauxiliar){
                        case 6: 
                            //Erandi
                            $lugar_auxiliar = "Auxiliar 5";
                            break;
                        case 10: 
                            //Rosario
                            $lugar_auxiliar = "Auxiliar 2";
                            break;
                        case 8: 
                            //Mayra
                            $lugar_auxiliar = "Auxiliar 3";
                            break;
                        case 9: 
                            //Luis
                            $lugar_auxiliar = "Auxiliar 4";
                            break;
                        case 3: 
                            //Yessiu
                            $lugar_auxiliar = "Auxiliar 5";
                            break;
                        case 7: 
                            //Clever
                            $lugar_auxiliar = "Auxiliar 6";
                            break;
                        case 5: 
                            //Sandra
                            $lugar_auxiliar = "Auxiliar 7";
                            break;
                        default:
                            $lugar_auxiliar = "Pendiente";
                            break;
                    }
                    
                    $turno_update= array(
                        'auxiliar'       => $IDauxiliar,
                        'lugar_auxiliar' => $lugar_auxiliar
                    );
                    $disponible_update= array(
                        'estatus'       => 'Ocupado'
                    );

                    $turno = Turnos::find($id_turno);
                    $turno->update($turno_update);

                    $persona = DB::table('turno_disponible')
                    ->where('id_auxiliar', $IDauxiliar)
                    ->where('fecha', $fecha_actual)
                    ->update(['estatus' => 'Ocupado']);
                }
            }
        }
        
        return redirect()->route('turnos');
    }

    public function noactivo($id)
    {
        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");

        $ocupados = TurnoDisponible::where('fecha', $fecha_actual)
        ->where('id_auxiliar', $id)
        ->get();

        if(count($ocupados) == 0){
            $data_insertar_disponible= array(
                'id_auxiliar'   => $id,
                'fecha'         => $fecha_actual,
                'hora'          => $hora_actual,
                'estatus'       => 'Ocupado'
            );
            TurnoDisponible::create($data_insertar_disponible);
        }else{
            $data_update = DB::table('turno_disponible')
            ->where('id_auxiliar', $id)
            ->update(['estatus' => 'Ocupado']);
        }

        return redirect()->route('turnos');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();
        return redirect()->route('usuarios');
    }

    public function misturnos(){
        $id = auth()->user()->id;
        $fecha_actual = date('Y-m-d');

        /////Validar si es auxiliar o exepcion /////
        $misturnos = Turnos::where('fecha', $fecha_actual)
        ->where('auxiliar', $id)
        ->get();

        return view('turnos.misturnos',compact('misturnos'));
    }

    public function terminado($id)
    {
        // $id es la variable de la tabla de turnos
        //Obtenemos el id de del auxiliar que esta terminado el turno 
        $turnos = Turnos::where('id', $id)->first();
        $IDauxiliar = $turnos["auxiliar"];
       
        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");

        $turno_update= array(
            'hora_fin'      =>  $hora_actual,
            'estatus'       => 'atendido'
        );
        $disponible_update= array(
            'estatus'       => 'Disponible'
        );

        //Se actualizan los estatus
        $turno = Turnos::find($id);
        $turno->update($turno_update);

        $persona = DB::table('turno_disponible')
        ->where('id_auxiliar', $IDauxiliar)
        ->where('fecha', $fecha_actual)
        ->update(['estatus' => 'Disponible']);

        //Se va buscar en fila si existe algun otro y se va asiganar
        if($turnos["exepcion"] == "Si"){
            $user = User::find($IDauxiliar);

            $relacionEloquent = 'roles';
            $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
                return $query->where('name', '=', 'Excepcion');
            })
            ->where('delegacion', $user["delegacion"])
            ->get();
            
            $turno_update= array(
                'auxiliar'       => $usuariosauxiliares[0]["id"],
                'lugar_auxiliar' => "Departamento de casos de Excepción"
            );
            $disponible_update= array(
                'estatus'       => 'Ocupado'
            );

            $turno = Turnos::find($id);
            $turno->update($turno_update);

            $persona = DB::table('turno_disponible')
            ->where('id_auxiliar', $usuariosauxiliares[0]["id"])
            ->where('fecha', $fecha_actual)
            ->update(['estatus' => 'Ocupado']);
        }
        else if($id == 3 || $id == 5 || $id ==7 ){
            $ocupados = Turnos::where('fecha', $fecha_actual)
            ->where('auxiliar', 0)
            ->where('tipo', 'Solicitud')
            ->orderBy('id', 'asc')->first();
            //Si hay fila se va asiganar el primero de la fila al axulilar libre
            if(!empty($ocupados)){
                $id_turno = $ocupados["id"];

                //Relacion auxiliar con usuario
                switch($IDauxiliar){
                    case 6: 
                        //Erandi
                        $lugar_auxiliar = "Auxiliar 5";
                        break;
                    case 10: 
                        //Rosario
                        $lugar_auxiliar = "Auxiliar 2";
                        break;
                    case 8: 
                        //Mayra
                        $lugar_auxiliar = "Auxiliar 3";
                        break;
                    case 9: 
                        //Luis
                        $lugar_auxiliar = "Auxiliar 4";
                        break;
                    case 3: 
                        //Yessiu
                        $lugar_auxiliar = "Auxiliar 5";
                        break;
                    case 7: 
                        //Clever
                        $lugar_auxiliar = "Auxiliar 6";
                        break;
                    case 5: 
                        //Sandra
                        $lugar_auxiliar = "Auxiliar 7";
                        break;
                    default:
                        $lugar_auxiliar = "Pendiente";
                        break;
                }
                
                $turno_update= array(
                    'auxiliar'       => $IDauxiliar,
                    'lugar_auxiliar' => $lugar_auxiliar
                );
                $disponible_update= array(
                    'estatus'       => 'Ocupado'
                );

                $turno = Turnos::find($id_turno);
                $turno->update($turno_update);

                $persona = DB::table('turno_disponible')
                ->where('id_auxiliar', $IDauxiliar)
                ->where('fecha', $fecha_actual)
                ->update(['estatus' => 'Ocupado']);
            }
        }
        else{
            $ocupados = Turnos::where('fecha', $fecha_actual)
            ->where('auxiliar', 0)
            ->orderBy('id', 'asc')->first();
            //Si hay fila se va asiganar el primero de la fila al axulilar libre
            if(!empty($ocupados)){
                $id_turno = $ocupados["id"];

                //Relacion auxiliar con usuario
                switch($IDauxiliar){
                    case 6: 
                        //Erandi
                        $lugar_auxiliar = "Auxiliar 5";
                        break;
                    case 10: 
                        //Rosario
                        $lugar_auxiliar = "Auxiliar 2";
                        break;
                    case 8: 
                        //Mayra
                        $lugar_auxiliar = "Auxiliar 3";
                        break;
                    case 9: 
                        //Luis
                        $lugar_auxiliar = "Auxiliar 4";
                        break;
                    case 3: 
                        //Yessiu
                        $lugar_auxiliar = "Auxiliar 5";
                        break;
                    case 7: 
                        //Clever
                        $lugar_auxiliar = "Auxiliar 6";
                        break;
                    case 5: 
                        //Sandra
                        $lugar_auxiliar = "Auxiliar 7";
                        break;
                    default:
                        $lugar_auxiliar = "Pendiente";
                        break;
                }
                
                $turno_update= array(
                    'auxiliar'       => $IDauxiliar,
                    'lugar_auxiliar' => $lugar_auxiliar
                );
                $disponible_update= array(
                    'estatus'       => 'Ocupado'
                );

                $turno = Turnos::find($id_turno);
                $turno->update($turno_update);

                $persona = DB::table('turno_disponible')
                ->where('id_auxiliar', $IDauxiliar)
                ->where('fecha', $fecha_actual)
                ->update(['estatus' => 'Ocupado']);
            }
        }

        return redirect()->route('misturnos');
    }

    public function turnos(){
        $id = auth()->user()->id;
        $user = User::find($id);
        $fecha_actual = date('Y-m-d');

        $turnos = DB::table('turnos')
        ->where('turnos.fecha', $fecha_actual)
        ->where('turnos.delegacion', $user["delegacion"])
        ->where('turnos.estatus','no atendido')
        ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
        ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.exepcion')
        ->get();

        
        return view('turnos.turnos',compact('turnos'));
    }

    public function estadistica(){
        $id = auth()->user()->id;
        $user = User::find($id);

        $auxiliares = User::whereHas('roles', function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        return view('turnos.estadistica',compact('auxiliares'));
    }

    public function mostrar(Request $request){
        //Voy a recibir todos los parametros en voy a realizar la consulta y mostrar los datos
        $data = $request->all();

        request()->validate([
            'fecha_inicial' => 'required|date',
            'fecha_final'   => 'required|date',
        ], $data);

        $id = auth()->user()->id;
        $user = User::find($id);


        if($data["auxiliares"] == "" && $data["tipo"] == ""){
            $suma_turnos = DB::table('turnos')
            ->where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->selectRaw('count(id) as total')
            ->first();

            $turnos = Turnos::where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
            ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.hora_fin','turnos.updated_at')
            ->get();

            
        }
        //Solo se agrego el auxiliar
        else if($data["auxiliares"] != "" && $data["tipo"] == ""){
            $suma_turnos = DB::table('turnos')
            ->where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.auxiliar',$data["auxiliares"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->selectRaw('count(id) as total')
            ->first();


            $turnos = Turnos::
            where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.auxiliar',$data["auxiliares"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
            ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.hora_fin','turnos.updated_at')
            ->get();
        }
        else if($data["auxiliares"] == "" && $data["tipo"] != ""){
            if($data["tipo"] == "exepcion"){
                $suma_turnos = DB::table('turnos')
                ->where("turnos.fecha",">=",$data["fecha_inicial"])
                ->where('turnos.fecha',"<=", $data["fecha_final"])
                ->where('turnos.exepcion',"Si")
                ->where('turnos.delegacion', $user["delegacion"])
                ->selectRaw('count(id) as total')
                ->first();

                $turnos = Turnos::
                where("turnos.fecha",">=",$data["fecha_inicial"])
                ->where('turnos.fecha',"<=", $data["fecha_final"])
                ->where('turnos.exepcion',"Si")
                ->where('turnos.delegacion', $user["delegacion"])
                ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
                ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.hora_fin','turnos.updated_at')
                ->get();
            }
            else{
                $suma_turnos = DB::table('turnos')
                ->where("turnos.fecha",">=",$data["fecha_inicial"])
                ->where('turnos.fecha',"<=", $data["fecha_final"])
                ->where('turnos.tipo',$data["tipo"])
                ->where('turnos.delegacion', $user["delegacion"])
                ->selectRaw('count(id) as total')
                ->first();


                $turnos = Turnos::
                where("turnos.fecha",">=",$data["fecha_inicial"])
                ->where('turnos.fecha',"<=", $data["fecha_final"])
                ->where('turnos.tipo',$data["tipo"])
                ->where('turnos.delegacion', $user["delegacion"])
                ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
                ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.hora_fin','turnos.updated_at')
                ->get();
            }
        }
        else{
            $suma_turnos = DB::table('turnos')
            ->where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.tipo',$data["tipo"])
            ->where('turnos.auxiliar',$data["auxiliares"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->selectRaw('count(id) as total')
            ->first();


            $turnos = Turnos::
            where("turnos.fecha",">=",$data["fecha_inicial"])
            ->where('turnos.fecha',"<=", $data["fecha_final"])
            ->where('turnos.tipo',$data["tipo"])
            ->where('turnos.auxiliar',$data["auxiliares"])
            ->where('turnos.delegacion', $user["delegacion"])
            ->leftjoin('users', 'users.id', '=', 'turnos.auxiliar')
            ->select('users.name','turnos.id','turnos.solicitante','turnos.fecha','turnos.hora','turnos.estatus','turnos.tipo','turnos.hora_fin','turnos.updated_at')
            ->get();
        }

        return view('turnos.mostrar',compact('turnos','suma_turnos'));        
    }

    public function cambiar($id)
    {
        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");
        $id_user = auth()->user()->id;
        $user = User::find($id_user);

        //Se actualizan los estatus
        $turno              = Turnos::find($id);
        $IDauxiliar         = $turno["auxiliar"];
        
        $disponibles     = TurnoDisponible::where('fecha', $fecha_actual)->where('estatus', 'Disponible')->get();
        $listado_ocupados   = array();
        $listado_auxiliares = array();
        $relacionEloquent = 'roles';
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();
        
        foreach($usuariosauxiliares as $token ){
            //Validar que solo sea morelia
            //if($token["delegacion"] == "Morelia"){
                //Si la lista no esta vacia
                if($turno["tipo"] == "Ratificación"){
                    //Validar si random es diferente de 3-5-7
                    if($token["id"] == 3 || $token["id"] == 5 || $token["id"] ==7 ){
                    }
                    else{
                        array_push($listado_auxiliares, $token["id"]);
                    }                    
                }else{
                    array_push($listado_auxiliares, $token["id"]);
                }
            //}
        }
        //validar si hay disponibles
        $random = array_rand($listado_auxiliares);

        switch($listado_auxiliares[$random]){
            case 6: 
                //Erandi
                $lugar_auxiliar = "Auxiliar 5";
                break;
            case 10: 
                //Rosario
                $lugar_auxiliar = "Auxiliar 2";
                break;
            case 8: 
                //Mayra
                $lugar_auxiliar = "Auxiliar 3";
                break;
            case 9: 
                //Luis
                $lugar_auxiliar = "Auxiliar 4";
                break;
            case 3: 
                //Yessiu
                $lugar_auxiliar = "Auxiliar 5";
                break;
            case 7: 
                //Clever
                $lugar_auxiliar = "Auxiliar 6";
                break;
            case 5: 
                //Sandra
                $lugar_auxiliar = "Auxiliar 7";
                break;
            default:
                $lugar_auxiliar = "Pendiente";
                break;
        }

        $turno_update= array(
            'hora_fin'      =>  $hora_actual,
            'auxiliar'      =>  $listado_auxiliares[$random],
            'lugar_auxiliar'=>  $lugar_auxiliar
        );
        $disponible_update= array(
            'estatus'       => 'Disponible'
        );

        $turno->update($turno_update);
        $turno_disponible   = TurnoDisponible::where('id_auxiliar', $IDauxiliar)->where('fecha', $fecha_actual)->first();
        if($turno_disponible != null){
            $turno_disponible->update($disponible_update);
        }
        
        return redirect()->route('turnos.listado');
    }

    public function terminado_confirmar($id){
        $turno = Turnos::find($id);
        return view('turnos.confirmar', compact('turno'));
    }

    public function edit(Request $request)
    {
        $data = $request->all();
        $id_user = auth()->user()->id;
        $user = User::find($id_user);
        $fecha_actual = date('Y-m-d');

        $relacionEloquent = 'roles';
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Excepcion');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        $turno_update= array(
            'solicitante'   => $data["nombre"],
            'tipo'          => $data["tipo"],
            'edad'          => $data["edad"],
            'sexo'          => $data["sexo"],
            'conflicto'     => $data["conflicto"],
            'vulnerables'   => $data["vulnerables"],
            'estatus'       => "atendido"
        );

        $turno = Turnos::find($data["id"]);
        $turno->update($turno_update);

        
        $persona = DB::table('turno_disponible')
        ->where('id_auxiliar', $usuariosauxiliares[0]["id"])
        ->where('fecha', $fecha_actual)
        ->update(['estatus' => 'Ocupado']);



        return redirect()->route('misturnos');
    }

    public function cambio($id){
        $id_user = auth()->user()->id;
        $user = User::find($id_user);

        $relacionEloquent = 'roles';
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Excepcion');
        })
        ->where('delegacion', $user["delegacion"])
        ->get();

        $turno_update= array(
            'auxiliar'      =>  $usuariosauxiliares[0]["id"],
            'lugar_auxiliar'=> "Departamento de Igualdad de Género"
        );

        $turno = Turnos::find($id);
        $turno->update($turno_update);

        return redirect()->route('misturnos');
    }
}
