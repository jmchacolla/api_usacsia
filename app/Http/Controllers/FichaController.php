<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use carbon\Carbon;

use App\Http\Requests;
use App\Models\Ficha;
use App\Models\Persona_tramite;
use App\Models\Persona;


class FichaController extends Controller
{
    //
    public function index(){
    	$ficha = Ficha::all();
    	return response()->json(['status'=>'ok','mensaje'=>'exito','ficha'=>$ficha],200);
    }

    public function store(Request $request){
    	$ficha = new Ficha();
		$ficha->pt_id = $request->pt_id;
    	$ficha->fic_numero = $request->fic_numero;
    	$ficha->fic_estado = $request->fic_estado;
	    $ficha->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','ficha'=>$ficha],200);
    }
    
    public function show($fic_id){
    	$ficha = Ficha::find($fic_id);    	   	
    	if (!$ficha)
        {
    		return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una ficha con ese código.'])],404);
        }
	    return response()->json(['status'=>'ok','mensaje'=>'exito','ficha'=>$ficha],200);
    }

    public function update(Request $request, $fic_id){
    	$ficha = Ficha::find($fic_id);
    	$ficha->fic_numero = $request->fic_numero;
    	$ficha->fic_estado = $request->fic_estado;
	    $ficha->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','ficha'=>$ficha],200);
    }
    public function fichasfecha(Request $request)
    {
        # code...
        $fecha1=$request->fecha1;
        $fecha2=$request->fecha2;
        $fic_estado=$request->fic_estado;
        $fichas=Ficha::select('persona.per_id','persona.per_nombres','persona.per_apellido_primero','persona.per_apellido_segundo','persona.per_genero','persona.per_ocupacion', 'ficha.fic_numero', 'ficha.fic_id','ficha.fic_fecha', 'fic_estado', 'persona_tramite.pt_id', 'persona_tramite.pt_numero_tramite')
        ->join('persona_tramite', 'persona_tramite.pt_id','=', 'ficha.pt_id')
        ->join('persona','persona.per_id','=','persona_tramite.per_id')
        ->where('fic_fecha', '>=', $fecha1)
        ->where('fic_fecha', '<=', $fecha2)
        ->get();
        return response()->json(['status'=>'ok','mensaje'=>'exito','fichas'=>$fichas],200);
    }
}

