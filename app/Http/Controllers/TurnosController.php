<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Turnos;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Vamos a traer un usuario para asignarle los roles
        $id_usuario = Auth::id();
        return view('turnos.crear', compact('id_usuario'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        request()->validate([
            'nombre' => 'required',
        ], $data);

        	
        $fecha_actual = date('Y-m-d');
        $hora_actual  = date("H:i:s");
        
        $consecutivo = Turnos::where('fecha', $fecha_actual)->get();
        //seleccionar el campo consecutivo de la fecha actual consecutivo
        //obtener el axiliar disponible auxiliar
        $data_insertar= array(
            'solicitante'   => $data["nombre"],
            'fecha'         => $fecha_actual,
            'hora'          => $hora_actual,
            'estatus'       => 'no atendido'
        );

        $user = User::create($input);
        
        return redirect()->route('usuarios');

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
