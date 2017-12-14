<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Muestra;
use App\Models\Prueba_laboratorio;

class MuestraController extends Controller
{
    //
     public function store(Request $request)
    {
        $muestra =new Muestra();
        $muestra->pt_id=$request->pt_id;
        $muestra->mue_num_muestra=$request->mue_num_muestra;
        $muestra->save();

        return response()->json(['status'=>'ok',"msg" => "exito",'muestra'=>$muestra],200); 
    }
    public function index()
    {

        $muestra =Muestra::select('per_ci','per_ci_expedido','persona_tramite.pt_id','per_nombres','per_apellido_primero','per_apellido_segundo','mue_num_muestra')
        ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->get();
        return response()->json(['status'=>'ok',"msg" => "exito",'muestra'=>$muestra],200); 
    }

      /*datos de la muestra*/
    public function show($mue_id)
    {
        $muestra =Muestra::select('per_ci','per_ci_expedido','persona_tramite.pt_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','mue_num_muestra','mue_tipo','mue_fecha') 
        ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->where('muestra.mue_id',$mue_id)
        ->first();
        return response()->json(['status'=>'ok',"msg" => "exito",'muestra'=>$muestra],200); 
    }

    public function buscar_numero_muestra($mue_num_muestra)
    {

        $hoy= date('Y-m-d');
        $muestra =Muestra::select('per_ci','per_ci_expedido','persona_tramite.pt_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','mue_id','mue_num_muestra','mue_tipo','mue_fecha') 
        ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->where('muestra.mue_num_muestra',$mue_num_muestra)
        ->where('muestra.mue_fecha',$hoy)
        ->first();
        
        
        if(count($muestra)!=0){
            $idemuestra=$muestra->mue_id;
            $existe=Prueba_laboratorio::select('pl_id','prueba_laboratorio.mue_id','pl_estado','per_ci','per_ci_expedido','persona_tramite.pt_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','mue_num_muestra','mue_tipo')
            ->join('muestra','muestra.mue_id','=','prueba_laboratorio.mue_id')
            ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
            ->join('persona','persona.per_id','=','persona_tramite.per_id')
            ->where('prueba_laboratorio.mue_id',$idemuestra)
            ->first();
            if(count($existe)!=0){
                return response()->json(['status'=>'ok','msg'=>"con prueba",'pruebalabo'=>$existe],200); 
            }
        }

        return response()->json(['status'=>'ok',"msg" => "sin prueba",'muestra'=>$muestra,'hoy'=>$hoy],200); 
    }
}
