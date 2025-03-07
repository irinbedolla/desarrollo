<?php

namespace App\Http\Controllers;

use App\Models\Turnos;
use App\Models\Municipio;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SeerChatP; 
use App\Models\SeerChatR; 
use App\Models\SeerChatRP;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function chats()
    {   
        $preguntasChats = SeerChatP::all();
        return view('chat', compact('preguntasChats'));
    }
      
    public function store(Request $request)
    {
        $data = $request->all();

        //validando información
        $validatedData=$request->validate([
            'nombre_completo' => 'required|string',
            'ciudad'          => 'required|string',
            'idPregunta'      => 'required|numeric',
        ]);
        //Se crea un arreglo para insertar la información
        $data_insert=array(
            'nombre_completo'  => $data["nombre_completo"],
             'ciudad'=> $data["ciudad"],
        );
        SeerChatR::create($data_insert); 

        $idRegistro = SeerChatR::latest('id')->first();
        $data_insertP=array(
            'id_registro'  => $idRegistro->id,
            'id_pregunta'  => $data["idPregunta"],
        );
        SeerChatRP::create($data_insertP); 
        //Obtienes Ciudad y el nombre
        $registro=SeerChatR::find($idRegistro->id);
        //Obtiene todas las preguntas
        $preguntasChats=SeerChatP::all();
        //Historial de preguntas
        $res=SeerChatRP::where('id_registro',$idRegistro->id);
        //ID de registro
        $id=$idRegistro->id;
        //$datos = SeerChatR::latest()->first();
        $idPregunta = SeerChatRP::latest('id_pregunta')->first();
        //Obtiene la ultima pregunta
        $ver_res=SeerChatP::find($idPregunta->id_pregunta);

        return view('RespuestasChat', compact('id','registro','res','ver_res','preguntasChats','idPregunta'));
    }

    public function storeUno(Request $request)
    {
        $data = $request->all();
        
        //validando información
        $validatedData=$request->validate([
            'idPregunta'      => 'required|numeric',
            'id'              => 'required|numeric'
        ]);
        $data_insertP=array(
            'id_registro'  =>  $data["id"],
            'id_pregunta'  => $data["idPregunta"],
        );
        SeerChatRP::create($data_insertP); 

        //Obtienes Ciudad y el nombre
        $registro=SeerChatR::find($data["id"]);
        //Obtiene todas las preguntas
        $preguntasChats=SeerChatP::all();
        //Historial de preguntas
        $res=SeerChatRP::join('chat_preguntas','chat_preguntas.id','=','chat_rp.id_pregunta')
        ->join('chat_registro','chat_registro.id','=','chat_rp.id_registro')
        ->where('id_registro',$data["id"])
        ->select('chat_preguntas.pregunta','chat_preguntas.respuesta')
        ->get();
        //dd($res);
        //ID de registro
        $id=$data["id"];
        //$datos = SeerChatR::latest()->first();
        $idPregunta = SeerChatRP::latest('id_pregunta')->first();
        //Obtiene la ultima pregunta
        $ver_res=SeerChatP::find($idPregunta->id_pregunta);

        return view('RespuestasChat', compact('id','registro','res','ver_res','preguntasChats','idPregunta'));
    }




/*
        // Guarda registros
        $data_insertarR= array(
            'nombre_completo'  => $request->input('nombre_completo'),
            'ciudad'   => $request->input('ciudad'),
            
        );
        $r=SeerChatR::create($data_insertarR);

        $data_insertarP= array(
            'id'  => $request->input('idPregunta'),
        );
        $data_insertarR = $r->RegistroenChat()->create($chat_rp_insertar);
        $data_insertarP = RegistroenChat()->create($chat_rp_insertar);
        //$data_insertarR = $registro->RegistroenChat()->create($chat_rp_insertar);
        //$data_insertarP = $preguntasChats->RegistroenChat()->create($chat_rp_insertar);
        //SeerChatRP::create($data_insertarR);
        /*
        $registro = SeerChatR::create($data_insertarR);
        $data_insertarR = $registro->chatRegistrosPreguntas()->create($chat_rp_insertar);
        $data_insertarP = $preguntasChats->chatRegistrosPreguntas()->create($chat_rp_insertar);*/

      /*  $idPregunta=$request->idPregunta;
        $preguntasChats = SeerChatPreg::all();
        $respuesta = SeerChatPreg::find($idPregunta);*/
        
        //$datos = SeerChat::latest()->first();
      //  $datos=SeerChatRP::latest()->first();
        //return view('chat', compact('preguntasChats','r' ));
       // return redirect()->route('RespuestasChat.store')->with('success', 'registro');
        // Agregar las preguntas seleccionadas al registro
        //$registro->chat_resgistros_preguntas()->attach($request->input('chat_resgistros_preguntas'));
        //return redirect()->route('chat', ['idRegistro' => $registro->idRegistro]);
          
   // }




    //Muestra las preguntas guardadas en la tabla chat_preguntas
   /* public function chats()
    {   //$idRegistro = null
        $preguntasChats = SeerChatP::all();
        // Si se está agregando a un registro ya existente, recuperamos ese registro
      /*  if ($idRegistro) {
            $registro = SeerChatR::find($idRegistro);
        } else {
            $registro = null;
        }*/
    /*    return view('chat', compact('preguntasChats'));
    }
      
    public function store(Request $request)
    {
        //validando información
        $validatedData=$request->validate([
            'nombre_completo' => 'required|string',
            'ciudad' => 'required|string',
            'idPregunta' => 'required|exists:chat_preguntas,idPregunta'  
        ]);
       //$idPregunta=$request->idPregunta;
        //$preguntasChats = SeerChatPreg::all();
        $registro = SeerChatR::create([
            'nombre_completo' => $request->input('nombre_completo'),
            'ciudad' => $request->input('ciudad')
        ]);
/*
        // Guardar los nuevos registros
        $data_insertarR= array(
            'nombre_completo'  => $request->input('nombre_completo'),
            'ciudad'   => $request->input('ciudad')  
        );*/
/*
        $data_insertarP=array(
            'idPregunta' => $request->input('idPregunta')
        );

        $chat_rp_insertar = [
            'idRegistro' => $registro->idRegistro, // Clave foránea de la tabla chat_registro
           // 'idPregunta' => $preguntasChats->idPregunta // Clave foránea de la tabla chat_preguntas
        ];
*/
        //$registro = SeerChatR::create($data_insertarR);
        //$data_insertarR = $registro->chatRegistrosPreguntas()->create($chat_rp_insertar);
       // $data_insertarP = $preguntasChats->chatRegistrosPreguntas()->create($chat_registros_preguntas_insertar);

        //$registro = SeerChatR::find($idRegistro); // Obtener el registro al que quieres asociar la nueva pregunta

       /* $idPregunta=$request->idPregunta;
        $preguntasChats = SeerChatP::all();
        $respuesta = SeerChatP::find($idPregunta);
        
        //$datos = SeerChat::latest()->first();
        $datos=SeerChatRP::latest()->first();*/
      //  return view('chat', compact('preguntasChats', 'registro'));

        // Agregar las preguntas seleccionadas al registro
        //$registro->chat_resgistros_preguntas()->attach($request->input('chat_resgistros_preguntas'));
        //return redirect()->route('chat', ['idRegistro' => $registro->idRegistro]);
          
    //}
    /*
    public function storeUno(Request $request)
    {
        //validando información
        $validatedData=$request->validate([
            'nombre_completo' => 'required|string',
            'ciudad' => 'required|string',
            'chat_resgistros_preguntas' => 'required|array',
            'chat_resgistros_preguntas.*' => 'exists:chat_resgistros_preguntas,idPregunta',
        ]);
  
        $registro = SeerChat::create([
            'nombre_completo' => $request->input('nombre_completo'),
            'ciudad' => $request->input('ciudad'),
        ]);

        // Agregar las preguntas seleccionadas al registro
        $registro->chat_resgistros_preguntas()->attach($request->input('chat_resgistros_preguntas'));
        return redirect()->route('chat', ['idRegistro' => $registro->idRegistro]);
          
        // Guardar las nuevas preguntas en el registro actual
        $data_insertar= array(
            'nombre_completo'  => $request->input('nombre_completo'),
            'ciudad'   => $request->input('ciudad'),
            'idPregunta'      => $request->input('idPregunta')
        );
          
        SeerChat::create($data_insertar);
  
        $idPregunta=$request->idPregunta;
        $preguntasChats = SeerChatPreg::all();
        $respuesta = SeerChatPreg::find($idPregunta);
        $datos = SeerChat::latest()->first();
        return view('RespuestasChat', compact('idPregunta','preguntasChats','respuesta','datos'));
          /*
          //validando información
          $validatedData=$request->validate([
              'nombre_completo' => 'required|string',
              'ciudad' => 'required|string',
              'idPregunta' => 'required|exists:chat_preguntas,idPregunta',
          ]);
  
          // Verificar si es el primer registro o no
          $idRegistro = $request->input('idRegistro');
  
          // Si es un nuevo registro, guardamos el nombre y la ciudad
          if (!$idRegistro) {
              // Crear un nuevo registro con el nombre y la ciudad
              $idRegistro = SeerChat::create([
                  'nombre_completo' => $request->input('nombre_completo'),
                  'ciudad' => $request->input('ciudad'),
              ])->idRegistro; // Recuperamos el id del nuevo registro
          }
          // Guardar las nuevas preguntas en el registro actual
          $data_insertar= array(
              'nombre_completo'  => $request->input('nombre_completo'),
              'ciudad'   => $request->input('ciudad'),
              'idPregunta'      => $request->input('idPregunta')
          );
          SeerChat::create($data_insertar);
  
          $idPregunta=$request->idPregunta;
          $preguntasChats = SeerChatPreg::all();
          $registro = SeerChatPreg::find($idPregunta);
          $datos = SeerChat::latest()->first();
  
          return view('RespuestasChat', compact('idPregunta','preguntasChats','registro','datos','idRegistro'));
          */
   // }

    //Muestra las preguntas guardadas en la tabla chat_preguntas
  /*  public function chats()
    {   
        $preguntasChats = SeerChatPreg::all();
        return view('chat', compact('preguntasChats'));
    }

    public function create()
    {
        $registroChat = SeerChat::all();
    }
    
    public function store(Request $request)
    {
        //validando información
        $validatedData=$request->validate([
            'nombre_completo' => 'required|string',
            'ciudad' => 'required|string',
            'idPregunta' => 'required|exists:chat_preguntas,idPregunta',
        ]);

        $data_insertar= array(
            'nombre_completo'  => $request->input('nombre_completo'),
            'ciudad'   => $request->input('ciudad'),
            'idPregunta'      => $request->input('idPregunta')
        );
           SeerChat::create($data_insertar);
            //dd($data_insertar);

        $idPregunta=$request->idPregunta;
        $preguntasChats = SeerChatPreg::all();
        $registro = SeerChatPreg::find($idPregunta);
       // dd('$SeerChat');
        $datos = SeerChat::latest()->first();
        return view('RespuestasChat', compact('idPregunta','preguntasChats','registro','datos'));
        
    }*/
    /*public function storeUno(Request $request)
    {
        //validando información
        $validatedData=$request->validate([
            'nombre_completo' => 'required|string',
            'ciudad' => 'required|string',
            'idPregunta' => 'required|exists:chat_preguntas,idPregunta',
        ]);

        $data_insertar= array(
            'nombre_completo'  => $request->input('nombre_completo'),
            'ciudad'   => $request->input('ciudad'),
            'idPregunta'      => $request->input('idPregunta')
        );
            SeerChat::create($data_insertar);
            //dd($data_insertar);

        $idPregunta=$request->idPregunta;
        $preguntasChats = SeerChatPreg::all();
        $registro = SeerChatPreg::find($idPregunta);
        dd('$SeerChat');
        $datos = SeerChat::latest()->first();
        return view('RespuestasChat', compact('idPregunta','preguntasChats','registro','datos'));
        
    }*/
}