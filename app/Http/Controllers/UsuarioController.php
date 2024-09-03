<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

class UsuarioController extends Controller
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
        $usuarios = User::paginate(10);
        return view('usuarios.index',compact('usuarios'));

        /**
         * Para la paginación hay que agregar el siguiente fragmento de código
         * a la vista index
         * {!! $usuarios->links() !!}
         */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Vamos a traer un usuario para asignarle los roles
        $roles = Role::pluck('name','name')->all();
        return view('usuarios.crear', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Procedimiento para almacenar de los campos que vamos a ingresar
        $this->validate($request, [
            'name' => 'required',
            //Se guarda el campo email y se pide que sea de tipo email y único
            'email' => 'required|email|unique:users,email,',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        //Hacemos un hash del campo que tiene el password
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        //Documentación de spatie para asignar roles
        $user->assignRole($request->input('roles'));

        return redirect()->route('usuarios');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Se invocan los dos modelos User y rol
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('usuarios.editar', compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Primero se hace la validación como en store
        $this->validate($request, [
            'name' => 'required',
            //Se guarda el campo email y se pide que sea de tipo email y único y se agrega el id
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        //Hacemos un condicional sobre los inputs que tenemos
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        }else {
            $input = Arr::except($input, array('password'));
        }
        
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));
        return redirect()->route('usuarios');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id)->delete();
        //$usuarios = User::paginate(10);
        //return view('usuarios.index',compact('usuarios'));
        return redirect()->route('usuarios');
    }
}
