<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Tratamiento;


class TratamientoController extends Controller
{
    //

    public function index(){
		$tratamiento = Tratamiento::all();
    	return response()->json(['status'=>'ok', 'tratamiento'=> $tratamiento], 200);
	}

	public function show($trat_id){
		$tratamiento = Tratamiento::find($trat_id);
    	return response()->json(['status'=>'ok', 'enfermedades'=> $tratamiento], 200);
	}

	public function store(Request $request){
		$tratamiento = new Tratamiento();
		$tratamiento->trat_nombre=$request->trat_nombre;
		$tratamiento->trat_dosis=$request->trat_dosis;
		$tratamiento->trat_descripcion=$request->trat_descripcion;
	    $tratamiento->save();
	    return response()->json(['status'=>'ok', 'tratamiento'=> $tratamiento], 200);
	}

	public function update(Request $request, $trat_id){
		$tratamiento = Tratamiento::find($trat_id);
		$tratamiento->trat_nombre=$request->trat_nombre;
		$tratamiento->trat_dosis=$request->trat_dosis;
		$tratamiento->trat_descripcion=$request->trat_descripcion;
	    $tratamiento->save();
	    return response()->json(['status'=>'ok', 'tratamiento'=> $tratamiento], 200);
	}

		public function destroy($trat_id){
		$tratamiento = Tratamiento::find($trat_id);
		$tratamiento->delete();
	    return response()->json(['mensaje'=>'registro eliminado'], 200);
	}

	
	public function tratamientos_x_prasito($trat_id){
		$tratamiento = Tratamiento::find($trat_id);
		$tratamiento->delete();
	    return response()->json(['mensaje'=>'registro eliminado'], 200);
	}
}
