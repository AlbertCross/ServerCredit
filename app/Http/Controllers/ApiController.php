<?php

namespace App\Http\Controllers;

use App\Models\Prospecto;
use App\Models\Documento;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    //metodo mostrar el listado en la vista de lista de prospectos en la aplicacion
    public function getListado(){
        $listado = Prospecto::all();
        return response()->json($listado);
    }

    //obtengo el prospecto con sus documentos
    public function getProspecto($id){
        $prospecto=Prospecto::where('id',$id)->first();
        $documento=Documento::where('prospecto_id',$prospecto->id)->get();
        $prospecto=Arr::add($prospecto, 'documentos',$documento);
        return response()->json($prospecto);
    }

     //metodo para autorizar el prospecto haciendo una consulta y cambiando el estatus del prospecto desde la aplicacion
    public function putUpdate(Request $request)
    {
        $prospecto= Prospecto::find($request->id);
        $prospecto->estatus=2;
        $prospecto->save();
        $estado=['save'=>'Resuelto'];
        return response()->json($estado);
    }

    //metodo donde rechazo el prospecto guardado la observacion y cambiando el estatus del prospecto desde la aplicacion
    public function postObservacionRechazar(Request $request){
        $prospecto= Prospecto::find($request->id);
        $prospecto->observaciones=$request->observacion;
        $prospecto->estatus=3;
        $prospecto->save();
        $estado=['save'=>'Resuelto'];
        return response()->json($estado);
    }
    //funcion donde guardo el prospecto y retorno el id para proseguir con el captura de fotos
    public function registroProspecto(Request $request)
    {   
        $prospecto= new Prospecto();
        $prospecto->nombre=$request->nombre;
        $prospecto->apellido_p=$request->app;
        $prospecto->apellido_m=$request->apm;
        $prospecto->calle=$request->calle;
        $prospecto->colonia=$request->colonia;
        $prospecto->numero=$request->numero;
        $prospecto->codigo_postal=$request->codigop;
        $prospecto->telefono=$request->telefono;
        $prospecto->rfc=strtoupper($request->rfc);
        $prospecto->estatus=1;
        //guarda el prospecto
        if($prospecto->save()){
            $data=['id'=>$prospecto->id];
            return response()->json($data);
        }
    }
    //funcion donde obtengo el id del prospecto guardado y guardo la imagen
    public function uploadImg($id){
        $target_path = "documentos/";
        $target_path = $target_path . basename( $_FILES['file']['name']);
        $documento=new Documento();
        $documento->nombre_doc="documento de app";
        $documento->documento=$_FILES['file']['name'];
        $documento->prospecto_id=$id;

        if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)) {
            header('Content-type: application/json');
            $documento->save();
            $data = ['success' => true, 'message' => 'Upload and move success'];
            echo json_encode( $data );

        } else{
            header('Content-type: application/json');
            $data = ['error' => false, 'message' => 'There was an error uploading the file, please try again!'];
            echo json_encode( $data );
        }

     }
}
