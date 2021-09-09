<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Prospecto;
use Illuminate\Http\Request;
use Image;

class ProspectosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //verifica que este logeado
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retorna a la vista de registrar
        return view('layouts.registroProspecto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //se genera el prospecto del cliente
       // dd($request);
        $prospecto= new Prospecto();
        $prospecto->nombre=$request->nombre;
        $prospecto->apellido_p=$request->apellido_p;
        $prospecto->apellido_m=$request->apellido_m;
        $prospecto->calle=$request->calle;
        $prospecto->colonia=$request->colonia;
        $prospecto->numero=$request->numero;
        $prospecto->codigo_postal=$request->cp;
        $prospecto->telefono=$request->telefono;
        $prospecto->rfc=strtoupper($request->rfc);
        $prospecto->estatus=1;
        //guarda el prospecto
        if($prospecto->save()){
            
            //recorre los archivos subidos 
            for ($i=1; $i <= intval($request->poplets); $i++) { 
                $file= new Documento();
                //limpia la variable utilizada para guardar el documento
                $doc="";
                //verifica que haya archivos subidos
               if ($request->hasFile('poplet'.$i)) {
                   //guardo el documento en la variable para utilizarla
                  $doc = $request->file('poplet'.$i);
                  //registro el nombre del documento
                  $file->nombre_doc = $_POST['nombredoc'.$i];
                  //obtengo la extencion para verificar si es una imagen o un documento con la sentencia if
                  $extension=$doc->getClientOriginalExtension();
                        if ($extension=="jpg" || $extension=="png" || $extension=="jpeg") {
                            //si esta muy grande la imagen le bajo la resolucion
                            $image_resize = Image::make($request->file('poplet'.$i)->getRealPath());
                            $image_resize->resize(1200, null, function($constraint) {
                                $constraint->aspectRatio();
                                $constraint->upsize();
                            });
                            $image_resize->orientate();
                            //le cambio el nombre a la imagen por guardar
                            $nombre_archivo = 'img'.$i.'-'.$prospecto->id.'-'.$prospecto->nombre.'.'.$request->file('poplet'.$i)->getClientOriginalExtension();
                            //le digo donde guardar el documento
                            $image_resize->save('documentos/' . $nombre_archivo);
                            $file->documento =$nombre_archivo;
                        }else{
                            $doc = $request->file('poplet'.$i);
                            //le cambio el nombre a la imagen por guardar
                            $filename = 'doc'.$i.'-'.$prospecto->id.'-'.$prospecto->nombre.'.'.$request->file('poplet'.$i)->getClientOriginalExtension();
                            //le digo donde guardar el documento
                            $doc->move(base_path().'/public/documentos/',$filename);
                            $file->documento =$filename;
                        }
               }
               //le guardo el id del prospecto al que pertenece
               $file->prospecto_id=$prospecto->id;
               
                //guarda el documento
               $file->save();
            }
            //lo mando al listado de prospectos
            return redirect('listado');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //metodo para mostrar la informacion del prospecto seleccionado en la vista de listado de prospectos
    public function show($id)
    {

        //consulta a las bases de datos donde la informacion la guardo en las variables y la mando a la vista
        $prospecto= Prospecto::where('id',$id)->first();
        $documentos= Documento::where('prospecto_id',$prospecto->id)->get();
        return view('layouts.verProspecto', compact('prospecto','documentos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //metodo para autorizar el prospecto haciendo una consulta y cambiando el estatus del prospecto
    public function update(Request $request)
    {
        $prospecto= Prospecto::find($request->prospecto_id);
        $prospecto->estatus=2;
        if($prospecto->save()){
            return redirect('listado');
        }
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
    }


    //metodo mostrar el listado en la vista de lista de prospectos
    public function listado(){
        $listado = Prospecto::all();
        return view('layouts.listado', compact('listado'));
    }

//metodo donde rechazo el prospecto guardado la observacion y cambiando el estatus del prospecto
    public function observacionRechazar(Request $request){
        $prospecto= Prospecto::find($request->prospecto_id);
        $prospecto->observaciones=$request->observaciones;
        $prospecto->estatus=3;
        if($prospecto->save()){
            return redirect('listado');
        }
    }
    
    //metodo mostrar el listado en la vista de lista de prospectos en la aplicacion
    public function getListado(){
        $listado = Prospecto::all();
        return response()->json($listado);
    }

     //metodo para autorizar el prospecto haciendo una consulta y cambiando el estatus del prospecto desde la aplicacion
    public function putUpdate(Request $request)
    {
        $prospecto= Prospecto::find($request->prospecto_id);
        $prospecto->estatus=2;
        $prospecto->save();
        $estado=['save'=>'Resuelto'];
        return response()->json($estado)
    }

    //metodo donde rechazo el prospecto guardado la observacion y cambiando el estatus del prospecto desde la aplicacion
    public function postObservacionRechazar(Request $request){
        $prospecto= Prospecto::find($request->prospecto_id);
        $prospecto->observaciones=$request->observaciones;
        $prospecto->estatus=3;
        $prospecto->save();
        $estado=['save'=>'Resuelto'];
        return response()->json($estado)
    }
}
