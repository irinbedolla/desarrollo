<?php

namespace App\Http\Controllers;

use App\Models\Turnos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('auth.login');
    }

    public function publico(){
        return view('welcome');
    }

    public function home()
    {
        //return redirect('home');
        return view('home');
    }

    public function pantalla()
    {
        $fecha_actual = date('Y-m-d');

        $turnos = DB::table('turnos')
        ->join('users', 'users.id', '=', 'turnos.auxiliar')
        ->select('users.id', 'users.name', 'turnos.solicitante')
        ->where('turnos.fecha', $fecha_actual)
        ->paginate(10);

        return view('pantalla', compact('turnos'));
    }
}
