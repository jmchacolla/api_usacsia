<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Prueba_laboratorio;
use App\Models\Persona_tramite;
use App\Models\Prueba_par;
use App\Models\Persona;

class Prueba_laboratorioController extends Controller
{
    //
     public function index(){
    	$prueba_laboratorio = Prueba_laboratorio::select('pl_id','per_nombres','per_apellido_primero','per_apellido_segundo', 'mue_num_muestra', 'pl_estado','pl_tipo', 'pl_color', 'pl_aspecto', 'pl_fecha_recepcion', 'pl_observaciones')
        ->join('muestra', 'muestra.mue_id','=','prueba_laboratorio.mue_id')
        ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->get();
        /*enviar el numero de tramite y el nombre de la persona a la que le pertenece*/
    	
        
    	return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

    public function store(Request $request){
    	$prueba_laboratorio = new Prueba_laboratorio();
    	$prueba_laboratorio->mue_id = $request->mue_id;
    	$prueba_laboratorio->fun_id = $request->fun_id;	
        $prueba_laboratorio->pl_estado = $request->pl_estado;
	    $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

        public function show($pl_id){
    	

    	$prueba = Prueba_laboratorio::select('pl_id','persona_tramite.pt_id','persona_tramite.pt_numero_tramite','persona.per_id', 'per_nombres', 'per_apellido_primero', 'per_apellido_segundo','pl_aspecto','pl_observaciones','pl_estado','pl_color','pl_tipo','pl_fecha_recepcion')
        ->join('muestra','muestra.mue_id','=','prueba_laboratorio.mue_id')
    	->join('persona_tramite', 'persona_tramite.pt_id','=','muestra.pt_id')
    	->join('persona', 'persona.per_id', '=','persona_tramite.per_id')
    	->where('pl_id',$pl_id)
    	->get()->first();


   
 
    	$resultado=compact('prueba_laboratorio','persona', 'prueba', 'pruebas_par');

	    return response()->json(['status'=>'ok','mensaje'=>'exito','resultado'=>$resultado],200);
    }

        public function update(Request $request, $pl_id){
    	$prueba_laboratorio = Prueba_laboratorio::find($pl_id);
    	$prueba_laboratorio->pl_estado = $request->pl_estado;
    	$prueba_laboratorio->pl_tipo = $request->pl_tipo;
    	$prueba_laboratorio->pl_color = $request->pl_color;
    	$prueba_laboratorio->pl_aspecto = $request->pl_aspecto;
        $prueba_laboratorio->pl_moco = $request->pl_moco;
        $prueba_laboratorio->pl_sangre = $request->pl_sangre;
    	$prueba_laboratorio->pl_fecha_recepcion = $request->pl_fecha_recepcion;
    	$prueba_laboratorio->pl_observaciones = $request->pl_observaciones;		
	    $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }


}
