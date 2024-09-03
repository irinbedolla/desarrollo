<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\Seer;
//Para sacar el Id del usuario
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Sedes;
use App\Models\Usuarios;


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
        $estadisticas = Seer::paginate(10);
        return view('estadisticas.index',compact('estadisticas'));
    }

    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name')->all();

   
        return view('estadisticas.crear', compact('user','userRole'));
    }

    public function store(){

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
}
