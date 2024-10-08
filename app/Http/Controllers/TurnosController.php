<?php

namespace App\Http\Controllers;

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
        $turnos = Turnos::paginate(10);
        return view('turnos.index',compact('turnos'));
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

        request()->validate([
            'nombre' => 'required',
        ], $data);

        	
        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");
        $numero_consecutivo = 0;
        $consecutivo  = Turnos::where('fecha', $fecha_actual)->get();
        $ocupados     = TurnoDisponible::where('fecha', $fecha_actual)->where('estatus', 'Ocupado')->get();

        if(empty($consecutivo["id"])){
            $numero_consecutivo = 1;
        }
        else{
            $numero_consecutivo = $consecutivo["consecutivo"]++;
        }
        
        $relacionEloquent = 'roles';
        $usuariosauxiliares = User::whereHas($relacionEloquent, function ($query) {
            return $query->where('name', '=', 'Auxiliar');
        })->get();

        $listado_ocupados = array();
        $listado_auxiliares = array(); 

        foreach($ocupados as $token ){
            array_push($listado_ocupados, $token["id_auxiliar"]);
        }

        foreach($usuariosauxiliares as $token ){
            //Validar que solo sea morelia
            if($token["delegacion"] == "Morelia"){
                //Si la lista no esta vacia
                if(!empty($listado_ocupados)){
                    //Buscamos si existen auxiliares libres
                    if(in_array($token["id"], $listado_ocupados)){
                        echo "Este no se agrega";
                    }
                    else{
                        echo "SI se agrega";
                        array_push($listado_auxiliares, $token["id"]);
                    }
                }
                //Si la lista es vacia agregamos a todos los auxiliares
                else{
                    array_push($listado_auxiliares, $token["id"]);
                }
            }
        }
        //validar si hay disponibles

        $random = array_rand($listado_auxiliares);

        $data_insertar= array(
            'consecutivo'   => $numero_consecutivo,
            'solicitante'   => $data["nombre"],
            'auxiliar'      => $listado_auxiliares[$random],
            'fecha'         => $fecha_actual,
            'hora'          => $hora_actual,
            'estatus'       => 'no atendido'
        );
        $data_insertar_disponible= array(
            'id_auxiliar'   => $listado_auxiliares[$random],
            'fecha'         => $fecha_actual,
            'hora'          => $hora_actual,
            'estatus'       => 'Ocupado'
        );

        Turnos::create($data_insertar);
        TurnoDisponible::create($data_insertar_disponible);

        //Fin de si hay dispobibles

        //Si no hay dispobibles
        
        
        //return redirect()->route('turnos');

    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        //
        $user = User::find($id)->delete();
        //$usuarios = User::paginate(10);
        //return view('usuarios.index',compact('usuarios'));
        return redirect()->route('usuarios');
    }
}
