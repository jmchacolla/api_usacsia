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
    	$prueba_laboratorio = Prueba_laboratorio::select('pl_id','per_nombres','per_apellido_primero','per_apellido_segundo', 'pl_num_muestra', 'pl_estado','pl_tipo', 'pl_tipo_atencion', 'pl_color', 'pl_aspecto', 'pl_fecha_recepcion', 'pl_observaciones')
        ->join('funcionario','funcionario.fun_id','=','prueba_laboratorio.fun_id')
        ->join('persona','persona.per_id','=','funcionario.per_id')
        ->get();
        /*enviar el numero de tramite y el nombre de la persona a la que le pertenece*/
    	
        
    	return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

    public function store(Request $request){
    	$prueba_laboratorio = new Prueba_laboratorio();
    	$prueba_laboratorio->pt_id = $request->pt_id;
    	$prueba_laboratorio->fun_id = $request->fun_id;
    	$prueba_laboratorio->pl_num_muestra = $request->pl_num_muestra;
    	$prueba_laboratorio->pl_estado = $request->pl_estado;
    	$prueba_laboratorio->pl_tipo = $request->pl_tipo;
    	$prueba_laboratorio->pl_tipo_atencion = $request->pl_tipo_atencion;
    	$prueba_laboratorio->pl_color = $request->pl_color;
    	$prueba_laboratorio->pl_aspecto = $request->pl_aspecto;
    	$prueba_laboratorio->pl_fecha_recepcion = $request->pl_fecha_recepcion;
    	$prueba_laboratorio->pl_observaciones = $request->pl_observaciones;		
	    $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

        public function show($par_id){
    	$prueba_laboratorio = Prueba_laboratorio::find($par_id); 

    	$prueba = Prueba_laboratorio::select('pl_id','persona_tramite.pt_id','persona_tramite.pt_numero_tramite','persona.per_id','funcionario.fun_id','fun_cargo', 'per_nombres', 'per_apellido_primero', 'per_apellido_segundo')
    	->join('persona_tramite', 'persona_tramite.pt_id','=','prueba_laboratorio.pt_id')
    	->join('funcionario', 'funcionario.fun_id','=','prueba_laboratorio.fun_id')
    	->join('persona', 'persona.per_id', '=','funcionario.per_id')
    	->where('pl_id',$par_id)
    	->get()->first();

    	$pt_id=$prueba->pt_id;
    	$persona = Persona_tramite::where('persona_tramite.pt_id',$pt_id)
    	->join('persona','persona.per_id','=','persona_tramite.per_id')
    	->select('per_nombres', 'per_apellido_primero', 'per_apellido_segundo')
    	->get()->first();


    	$pl_id=$prueba->pl_id;
    	$pruebas_par = Prueba_par::where('pl_id',$pl_id)
    	->join('parasito', 'parasito.par_id','=','prueba_par.par_id')
    	//->join('prueba_par_trat','prueba_par_trat.pp_id', '=', 'prueba_par.pp_id')
    	->select('parasito.par_id','par_nombre', 'pp_resultado')
    	->get();

    	


 
    	$resultado=compact('prueba_laboratorio','persona', 'prueba', 'pruebas_par');

	    return response()->json(['status'=>'ok','mensaje'=>'exito','resultado'=>$resultado],200);
    }

        public function update(Request $request, $pl_id){
    	$prueba_laboratorio = Prueba_laboratorio::find($pl_id);
    	$prueba_laboratorio->pl_num_muestra = $request->pl_num_muestra;
    	$prueba_laboratorio->pl_estado = $request->pl_estado;
    	$prueba_laboratorio->pl_tipo = $request->pl_tipo;
    	$prueba_laboratorio->pl_tipo_atencion = $request->pl_tipo_atencion;
    	$prueba_laboratorio->pl_color = $request->pl_color;
    	$prueba_laboratorio->pl_aspecto = $request->pl_aspecto;
    	$prueba_laboratorio->pl_fecha_recepcion = $request->pl_fecha_recepcion;
    	$prueba_laboratorio->pl_observaciones = $request->pl_observaciones;		
	    $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }


}
