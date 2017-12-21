<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Models\Prueba_laboratorio;
use App\Models\Persona_tramite;
use App\Models\Prueba_par;
use App\Models\Parasito;
use App\Models\Persona;
use App\Models\Funcionario;

use App\Models\Muestra;


class Prueba_laboratorioController extends Controller
{
    //
     public function index(){
    	$prueba_laboratorio = Prueba_laboratorio::select('pl_id','per_nombres','per_apellido_primero','per_apellido_segundo', 'mue_num_muestra', 'pl_estado','pl_tipo', 'pl_color', 'pl_aspecto', 'pl_fecha_recepcion', 'pl_observaciones')
        ->join('muestra', 'muestra.mue_id','=','prueba_laboratorio.mue_id')
        ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->get();
        if (!$prueba_laboratorio) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una prueba laboratorio con ese código.'])],404);
        }
        /*enviar el numero de tramite y el nombre de la persona a la que le pertenece*/
    	return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            
            'mue_id' => 'required',
            'fun_id' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        } 
    	$prueba_laboratorio = new Prueba_laboratorio();
    	$prueba_laboratorio->mue_id = $request->mue_id;
    	$prueba_laboratorio->fun_id = $request->fun_id;	
        $prueba_laboratorio->pl_estado = 'NO OBSERVADO'; 
        $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }

        public function show($pl_id){
    	
    	$prueba = Prueba_laboratorio::select('pl_id','prueba_laboratorio.fun_id','persona_tramite.pt_id','mue_num_muestra','persona_tramite.pt_numero_tramite','persona.per_id','per_ci','per_ci_expedido', 'per_nombres', 'per_apellido_primero', 'per_apellido_segundo','pl_aspecto','pl_observaciones','pl_estado','pl_color','pl_moco','pl_sangre','pl_tipo','pl_fecha_recepcion')
        ->join('muestra','muestra.mue_id','=','prueba_laboratorio.mue_id')
    	->join('persona_tramite', 'persona_tramite.pt_id','=','muestra.pt_id')
    	->join('persona', 'persona.per_id', '=','persona_tramite.per_id')
    	->where('pl_id',$pl_id)
    	->first();

        

        $fun_id=$prueba->fun_id;
        $funcionario=Funcionario::select('fun_id','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_ci','per_ci_expedido')
        ->join('persona','persona.per_id','=','funcionario.per_id')
        ->where('funcionario.fun_id',$fun_id)
        ->first();

        $pl_id=$prueba->pl_id;
        $pruebapar=Prueba_par::select('par_nombre','par_clasificacion')
        ->join('parasito','parasito.par_id','=','prueba_par.par_id')
        ->where('prueba_par.pl_id',$pl_id )
        ->get();
	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba,'funcionario'=>$funcionario,'parasitos'=>$pruebapar],200);
    }

        public function update(Request $request, $pl_id){

        $observado="NO OBSERVADO";
        $pruebapar=Prueba_laboratorio::select('prueba_par.pp_id')
        ->join('prueba_par','prueba_par.pl_id','=','prueba_laboratorio.pl_id')
        ->where('prueba_laboratorio.pl_id',$pl_id)
        ->get()->first();
        if($pruebapar){
            $observado='OBSERVADO';
        }

    	$prueba_laboratorio = Prueba_laboratorio::find($pl_id);
    	$prueba_laboratorio->pl_estado = $observado;
    	$prueba_laboratorio->pl_tipo = Str::upper($request->pl_tipo);
    	$prueba_laboratorio->pl_color = Str::upper($request->pl_color);
    	$prueba_laboratorio->pl_aspecto = Str::upper($request->pl_aspecto);
        $prueba_laboratorio->pl_moco = $request->pl_moco;
        $prueba_laboratorio->pl_sangre = $request->pl_sangre;
    	$prueba_laboratorio->pl_observaciones = ($request->pl_observaciones);		
	    $prueba_laboratorio->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio,'prueba_par'=>$pruebapar],200);
    }
    // debuelve la ultima prueba_laboratoriodel tramite
    public function ultima_pl_tramite($pt_id)
    {
        $pl=Prueba_laboratorio:: select('prueba_laboratorio.pl_id', 'prueba_laboratorio.pl_color', 'prueba_laboratorio.pl_aspecto', 'prueba_laboratorio.pl_fecha_recepcion','prueba_laboratorio.pl_estado', 'prueba_laboratorio.fun_id','muestra.mue_id', 'muestra.mue_num_muestra')
        ->join('muestra', 'muestra.mue_id', '=', 'prueba_laboratorio.mue_id')
        ->where('muestra.pt_id', '=', $pt_id)
        ->latest('prueba_laboratorio')
        ->first();
        if (!$pl) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una prueba laboratorio con ese código.'])],404);
        }
        $fun=Funcionario::find($pl->fun_id);
        $per=Persona::find($fun->per_id);
        $prupar=Prueba_par::select('prueba_par.pp_id', 'parasito.par_id','parasito.par_nombre', 'prueba_par.pl_id', 'prueba_par.pp_resultado')
        ->join('parasito', 'parasito.par_id', '=', 'prueba_par.par_id')
        ->where('prueba_par.pl_id', $pl->pl_id)
        ->get();
        if (!$pl) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una registros con ese código.'])],404);
        }
        return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$pl, 'prupar'=>$prupar,'fun'=>$fun, 'per'=>$per],200);
    }
    // Retorna el estado de la prueba de laboratorio, false si al menos uno de las prueba_par es positovo y false si todos son negativos
    public function estadopruebalaboratorio($pl_id)
    {
        $prueba_laboratorio=Prueba_laboratorio::find($pl_id);
        if (!$prueba_laboratorio) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una registros con ese código.'])],404);
        }
        return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_laboratorio'=>$prueba_laboratorio],200);
    }


}
