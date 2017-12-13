<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Enfermedad;

class EnfermedadController extends Controller
{
    //
	public function index(){
		$enfermedad = Enfermedad::all();
    	return response()->json(['status'=>'ok', 'enfermedad'=> $enfermedad], 200);
	}

	
	public function show($enfe_id){
		$enfermedad = Enfermedad::find($enfe_id);
		if (!$enfermedad) {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuenta una enfermedad con ese código.'])],404);
		}
    	return response()->json(['status'=>'ok', 'enfermedad'=> $enfermedad], 200);
	}

	//listar los tratamientos de una enfermedad enfe_id
	public function tratamientos_x_enfermedad($enfe_id){
		$enfermedad_tratamiento = Enfermedad::
		select('enfermedad.enfe_id','trat_nombre', 'trat_dosis','trat_descripcion')		
		->join('enfermedad_tratamiento','enfermedad_tratamiento.enfe_id','=','enfermedad.enfe_id')
		->join('tratamiento','tratamiento.trat_id','=','enfermedad_tratamiento.trat_id')
		->where('enfermedad.enfe_id',$enfe_id)
		->get();

		return response()->json(['status'=>'ok', 'enfermedad_tratamiento'=> $enfermedad_tratamiento], 200);
		
	}

	public function store(Request $request){
		$enfermedad = new Enfermedad();
	    $enfermedad->enfe_nombre = $request->enfe_nombre;
	    $enfermedad->enfe_causas = $request->enfe_causas;
	    $enfermedad->enfe_descripcion= $request->enfe_descripcion;
	    $enfermedad->enfe_prevencion =$request->enfe_prevencion ;
	    $enfermedad->enfe_necesita_ref = $request->enfe_necesita_ref ;
	    $enfermedad->save();

    	return response()->json(['status'=>'ok', 'enfermedad'=> $enfermedad], 200);
	}

	public function update(Request $request, $enfe_id){
		$enfermedad = Enfermedad::find($enfe_id);
	    $enfermedad->enfe_nombre = $request->enfe_nombre;
	    $enfermedad->enfe_causas = $request->enfe_causas;
	    $enfermedad->enfe_descripcion= $request->enfe_descripcion;
	    $enfermedad->enfe_prevencion =$request->enfe_prevencion ;
	    $enfermedad->enfe_necesita_ref = $request->enfe_necesita_ref ;
	    $enfermedad->save();

    	return response()->json(['status'=>'ok', 'enfermedad'=> $enfermedad], 200);
	}

	public function destroy($enfe_id){
		$enfermedad = Enfermedad::find($enfe_id);
 		if (!$enfermedad)
        {

            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuenta una enfermedad con ese código.'])],404);
        }
		$enfermedad->delete();
    	return response()->json(['mensaje'=>'registro eliminado correctamente'], 200);
	}

}
