<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Parasito;
use App\Models\Tratamiento;
use App\Models\Parasito_tratamiento;

class Parasito_tratamientoController extends Controller
{
    //
	public function store(Request $request)
    {
       
    	$parasito = new Parasito();
		$parasito->par_nombre = $request->par_nombre;
    	$parasito->par_descripcion = $request->par_descripcion;
    	$parasito->par_clasificacion = $request->par_clasificacion;
	    $parasito->save();

        $tratamiento = new Tratamiento();
  		$tratamiento->trat_nombre=$request->trat_nombre;
  		$tratamiento->trat_dosis=$request->trat_dosis;
  		$tratamiento->trat_descripcion=$request->trat_descripcion;
  	    $tratamiento->save();
          
        $parasito_tratamiento= new Parasito_tratamiento();
        $parasito_tratamiento->par_id=$parasito->par_id;
        $parasito_tratamiento->trat_id =$tratamiento->trat_id;
        $parasito_tratamiento->save();

        $resultado=compact('parasito', 'tratamiento','parasito_tratamiento');
        return response()->json(['status'=>'ok','mensaje'=>'exito','enfermedad_tratamiento'=>$resultado],200);
    }


    	//listar los tratamientos de una parasito enfe_id
	public function tratamientos_x_parasito($par_id){
		$parasito_tratamiento = Parasito::
		select('parasito.par_id','trat_nombre', 'trat_dosis','trat_descripcion')		
		->join('parasito_tratamiento','parasito_tratamiento.par_id','=','parasito.par_id')
		->join('tratamiento','tratamiento.trat_id','=','parasito_tratamiento.trat_id')
		->where('parasito.par_id',$par_id)
		->get();

		return response()->json(['status'=>'ok', 'parasito_tratamiento'=> $parasito_tratamiento], 200);
		
	}
}
