<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;

//Para sacar el Id del usuario
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PoderController extends Controller
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
        //Paginar las personas
        $poderes = Poder::paginate(10);
        return view('poderes.index', compact('poderes'));
    }

    public function create()
    {
        $id_usuario = Auth::id();
        return view('poderes.crear', compact('id_usuario'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        if(!isset($data['moreliaSucursal'])){
            $regionmorelia = "No";
        }
        else{
            $regionmorelia = $data['moreliaSucursal'];
        }
        if(!isset($data['uruapanSucursal'])){
            $regionuruapan = "No";
        }
        else{
            $regionuruapan = $data['uruapanSucursal'];
        }
        if(!isset($data['zamoraSucursal'])){
            $regionzamora = "No";
        }
        else{
            $regionzamora = $data['zamoraSucursal'];
        }

        //Validar documentacion
        request()->validate([
            'nombresAbogadoAlta'        => 'required',
            'apellidosAbogadoAlta'      => 'required',
            'telefonoAbogadoAlta'       => 'required|digits:10',
            'correoAbogadoAlta'         => 'required',
            'empresaAbogadoAlta'        => 'required',
            'curpAbogadoAlta'           => 'required',
            'domicilioAbogadoAlta'      => 'required',
            'fechaVigenciaAlta'         => 'required',
            'industriaAlta'             => 'required',
            'descripcionpoderAlta'      => 'required',
            'documentoIne'              => 'required',
            'documentoRepresentacion'   => 'required',
            'documentoPoder'            => 'nullable',
            'documentoAnexo'            => 'nullable',
        ], $data);

        //Validar las regiones
        if($regionmorelia == "No" && $regionuruapan == "No" && $regionzamora == "No"){
            return back()->withErrors('Debes seleccionar al menos una Región.');
        }


        //Validar que no exista el abogado
        $abogado = Poder::where(['nombres' => $data["nombresAbogadoAlta"], 'apellidos' => $data["apellidosAbogadoAlta"], 'empresa' => $data["empresaAbogadoAlta"]])->first();
        //User::where('username','like','%John%') -> first();
        if(!$abogado){
            if(!$request->file('documentoAnexo')){
                $Anexo = "Sin anexo";
            }
            else{
                $Anexo = $request->file('documentoAnexo')->getClientOriginalName();
            }
            if(!$request->file('documentoPoder')){
                $Poder = "Sin carta poder";
            }
            else{
                $Poder = $request->file('documentoPoder')->getClientOriginalName();
            }
            

            $data_insertar= array(
                'nombres'       => $data["nombresAbogadoAlta"],
                'apellidos'     => $data["apellidosAbogadoAlta"], 
                'telefono'      => $data["telefonoAbogadoAlta"], 
                'email'         => $data["correoAbogadoAlta"],
                'ine'           => $request->file('documentoIne')->getClientOriginalName(),
                'cedula'        => $Poder,
                'anexo'         => $Anexo,
                'representacion'=> $request->file('documentoRepresentacion')->getClientOriginalName(),
                'fechaRegistro' => date('y-m-d'),
                'fechaVigencia' => $data["fechaVigenciaAlta"],
                'empresa'       => $data["empresaAbogadoAlta"],
                'eliminado'     => 0,
                'curp'          => $data["curpAbogadoAlta"],
                'domicilio'     => $data["domicilioAbogadoAlta"],
                'rfc'           => $data["RFCAbogadoAlta"],
                'industria'     => $data["industriaAlta"],
                'poder'         => $data["descripcionpoderAlta"],
                'regionMorelia' => $regionmorelia,
                'regionUruapan' => $regionuruapan,
                'regionZamora'  => $regionuruapan,
                'estatus'       => "Pendiente"
            );


            $nombre_ine = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_IDENTIFICACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoIne'), $nombre_ine
            );

            $nombre_representación = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_REPRESENTACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoRepresentacion'), $nombre_representación
            );

            //Si no existe
            if(!isset($data["documentoAnexo"])){
                $nombre_anexo = "Sin anexo";
            }
            else{
                $nombre_anexo = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_ANEXO.pdf";
                $path = Storage::putFileAs(
                    'documentos_abogados', $request->file('documentoAnexo'), $nombre_anexo
                );
            }

            if(!isset($data["documentoPoder"])){
                $nombre_anexo = "Sin anexo";
            }
            else{
                $nombre_poder = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_PODER.pdf";
                $path = Storage::putFileAs(
                    'documentos_abogados', $request->file('documentoPoder'), $nombre_poder
                );
            }
            Poder::create($data_insertar);  
            return redirect()->route('poderes.index'); 
        }
        else{
            return back()->withErrors('El poder ya tiene asignado ese abogado.');
        }
    }

    public function show(Request $request)
    {
        $data = $request->all();
        
        if(!isset($data['moreliaSucursal'])){
            $regionmorelia = "No";
        }
        else{
            $regionmorelia = $data['moreliaSucursal'];
        }
        if(!isset($data['uruapanSucursal'])){
            $regionuruapan = "No";
        }
        else{
            $regionuruapan = $data['uruapanSucursal'];
        }
        if(!isset($data['zamoraSucursal'])){
            $regionzamora = "No";
        }
        else{
            $regionzamora = $data['zamoraSucursal'];
        }

        //Validar documentacion
        request()->validate([
            'nombresAbogadoAlta'        => 'required',
            'apellidosAbogadoAlta'      => 'required',
            'telefonoAbogadoAlta'       => 'required|digits:10',
            'correoAbogadoAlta'         => 'required',
            'empresaAbogadoAlta'        => 'required',
            'curpAbogadoAlta'           => 'required',
            'domicilioAbogadoAlta'      => 'required',
            'fechaVigenciaAlta'         => 'required',
            'industriaAlta'             => 'required',
            'descripcionpoderAlta'      => 'required',
            'documentoIne'              => 'required',
            'documentoRepresentacion'   => 'required',
            //'moreliaSucursal'           => 'required_without_all:uruapanSucursal,zamoraSucursal',
            //'uruapanSucursal'           => 'required_without_all:moreliaSucursal,zamoraSucursal',
            //'zamoraSucursal'            => 'required_without_all:moreliaSucursal,uruapanSucursal',
            'documentoPoder'            => 'nullable',
            'documentoAnexo'            => 'nullable',
        ], $data);

        //Validar las regiones
        if($regionmorelia == "No" && $regionuruapan == "No" && $regionzamora == "No"){
            return back()->withErrors('Debes seleccionar al menos una Región.');
        }

        //Validar que no exista el abogado
        $abogado = Poder::where(['nombres' => $data["nombresAbogadoAlta"], 'apellidos' => $data["apellidosAbogadoAlta"], 'empresa' => $data["empresaAbogadoAlta"]])->first();
        //User::where('username','like','%John%') -> first();
        if(!$abogado){
            if(!$request->file('documentoAnexo')){
                $Anexo = "Sin anexo";
            }
            else{
                $Anexo = $request->file('documentoAnexo')->getClientOriginalName();
            }
            if(!$request->file('documentoPoder')){
                $Poder = "Sin carta poder";
            }
            else{
                $Poder = $request->file('documentoPoder')->getClientOriginalName();
            }
            

            $data_insertar= array(
                'nombres'       => $data["nombresAbogadoAlta"],
                'apellidos'     => $data["apellidosAbogadoAlta"], 
                'telefono'      => $data["telefonoAbogadoAlta"], 
                'email'         => $data["correoAbogadoAlta"],
                'ine'           => $request->file('documentoIne')->getClientOriginalName(),
                'cedula'        => $Poder,
                'anexo'         => $Anexo,
                'representacion'=> $request->file('documentoRepresentacion')->getClientOriginalName(),
                'fechaRegistro' => date('y-m-d'),
                'fechaVigencia' => $data["fechaVigenciaAlta"],
                'empresa'       => $data["empresaAbogadoAlta"],
                'eliminado'     => 0,
                'curp'          => $data["curpAbogadoAlta"],
                'domicilio'     => $data["domicilioAbogadoAlta"],
                'rfc'           => $data["RFCAbogadoAlta"],
                'industria'     => $data["industriaAlta"],
                'poder'         => $data["descripcionpoderAlta"],
                'regionMorelia' => $regionmorelia,
                'regionUruapan' => $regionuruapan,
                'regionZamora'  => $regionuruapan,
                'estatus'       => "Pendiente"
            );

            unlink(storage_path('app/documentos_abogados/'.$poder->ine));
            $nombre_ine = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_IDENTIFICACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoIne'), $nombre_ine
            );

            unlink(storage_path('app/documentos_abogados/'.$poder->representacion));
            $nombre_representación = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_REPRESENTACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoRepresentacion'), $nombre_representación
            );

            //Si no existe
            if(!isset($data["documentoAnexo"])){
                $nombre_anexo = "Sin anexo";
            }
            else{
                unlink(storage_path('app/documentos_abogados/'.$poder->anexo));
                $nombre_anexo = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_ANEXO.pdf";
                $path = Storage::putFileAs(
                    'documentos_abogados', $request->file('documentoAnexo'), $nombre_anexo
                );
            }

            if(!isset($data["documentoPoder"])){
                $nombre_anexo = "Sin anexo";
            }
            else{
                unlink(storage_path('app/documentos_abogados/'.$poder->cedula));
                $nombre_poder = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_PODER.pdf";
                $path = Storage::putFileAs(
                    'documentos_abogados', $request->file('documentoPoder'), $nombre_poder
                );
            }
            Poder::create($data_insertar);  

            return back()->with('success', 'Poder registrado correctamente, tienes 10 dias habiles para pasar al CCL a confirmar tu documentacion.'); 
        }
        else{
            return back()->withErrors('El poder ya tiene asignado ese abogado.');
        }
    }

    public function edit($id)
    {
        
        $poder = Poder::find($id);
        return view('poderes.editar', compact('poder'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        $poder = Poder::find($id);



        if(!isset($data['moreliaSucursal'])){
            $regionmorelia = "No";
        }
        else{
            $regionmorelia = $data['moreliaSucursal'];
        }
        if(!isset($data['uruapanSucursal'])){
            $regionuruapan = "No";
        }
        else{
            $regionuruapan = $data['uruapanSucursal'];
        }
        if(!isset($data['zamoraSucursal'])){
            $regionzamora = "No";
        }
        else{
            $regionzamora = $data['zamoraSucursal'];
        }


        request()->validate([
            'nombresAbogadoAlta'        => 'required',
            'apellidosAbogadoAlta'      => 'required',
            'telefonoAbogadoAlta'       => 'required|digits:10',
            'correoAbogadoAlta'         => 'required',
            'empresaAbogadoAlta'        => 'required',
            'curpAbogadoAlta'           => 'required',
            'domicilioAbogadoAlta'      => 'required',
            'fechaVigenciaAlta'         => 'required',
            'industriaAlta'             => 'required',
            'descripcionpoderAlta'      => 'required',
            'documentoIne'              => 'nullable',
            'documentoRepresentacion'   => 'nullable',
            'documentoPoder'            => 'nullable',
            'documentoAnexo'            => 'nullable',
            'estatus'                   => 'required',
        ], $data);
        

        //Validar las regiones
        if($regionmorelia == "No" && $regionuruapan == "No" && $regionzamora == "No"){
            return back()->withErrors('Debes seleccionar al menos una Región.');
        }
        
        if(!$request->file('documentoIne')){
            $nombre_ine = $poder->ine;
        }
        else{
            $Ine = $request->file('documentoIne')->getClientOriginalName();
        }
        if(!$request->file('documentoRepresentacion')){
            $nombre_representación = $poder->representacion;
        }
        else{
            $Reprecentacion = $request->file('documentoRepresentacion')->getClientOriginalName();
        }
        if(!$request->file('documentoAnexo')){
            if($poder->anexo === "Sin anexo"){
                $Anexo = "Sin anexo";
            }
            else{
                $nombre_anexo = $poder->anexo;
            }
        }
        else{
            $Anexo = $request->file('documentoAnexo')->getClientOriginalName();
        }
        if(!$request->file('documentoPoder')){
            if($poder->cedula === "Sin anexo"){
                $Poder = "Sin anexo";
            }
            else{
                $nombre_poder = $poder->poder;
            }
        }
        else{
            $Poder = $request->file('documentoPoder')->getClientOriginalName();
        }

        if(isset($data["documentoIne"])){
            $nombre_ine = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_IDENTIFICACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoIne'), $nombre_ine
            );
        }

        if(isset($data["documentoRepresentacion"])){
            $nombre_representación = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_REPRESENTACION.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoRepresentacion'), $nombre_representación
            );
        }

        if(isset($data["documentoAnexo"])){
            $nombre_anexo = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_ANEXO.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoAnexo'), $nombre_anexo
            );
        }

        if(isset($data["documentoPoder"])){
            $nombre_poder = $data["nombresAbogadoAlta"]."".$data["apellidosAbogadoAlta"]."-".$data["empresaAbogadoAlta"]."_PODER.pdf";
            $path = Storage::putFileAs(
                'documentos_abogados', $request->file('documentoPoder'), $nombre_poder
            );
        }

        
        $data_update= array(
            'nombres'       => $data["nombresAbogadoAlta"],
            'apellidos'     => $data["apellidosAbogadoAlta"], 
            'telefono'      => $data["telefonoAbogadoAlta"], 
            'email'         => $data["correoAbogadoAlta"],
            'ine'           => $nombre_ine,
            'representacion'=> $nombre_representación,
            'cedula'        => $nombre_poder,
            'anexo'         => $nombre_anexo,
            'fechaRegistro' => date('y-m-d'),
            'fechaVigencia' => $data["fechaVigenciaAlta"],
            'empresa'       => $data["empresaAbogadoAlta"],
            'eliminado'     => 0,
            'curp'          => $data["curpAbogadoAlta"],
            'domicilio'     => $data["domicilioAbogadoAlta"],
            'rfc'           => $data["RFCAbogadoAlta"],
            'industria'     => $data["industriaAlta"],
            'poder'         => $data["descripcionpoderAlta"],
            'regionMorelia' => $regionmorelia,
            'regionUruapan' => $regionuruapan,
            'regionZamora'  => $regionuruapan,
            'estatus'       => $data["estatus"]
        );

        $poder->update($data_update);
        return redirect()->route('poderes.index');
    }


    public function destroy($id)
    {
        //Borrar la documentacion
        $poder = Poder::find($id);
        unlink(storage_path('app/documentos_abogados/'.$poder->ine));
        unlink(storage_path('app/documentos_abogados/'.$poder->representacion));
        if($poder->anexo !== "Sin anexo"){
            unlink(storage_path('app/documentos_abogados/'.$poder->anexo));
        }
        if($poder->cedula !== "Sin anexo"){
            unlink(storage_path('app/documentos_abogados/'.$poder->cedula));
        }
        
        $poder = Poder::find($id)->delete();
        return redirect()->route('poderes.index');
    }
}
