<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Muestra;

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
