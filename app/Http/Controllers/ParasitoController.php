<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Parasito;

class ParasitoController extends Controller
{
    //
    public function index(){
    	$parasito = Parasito::all();
    	
    	return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$parasito],200);
    }

        public function store(Request $request){
    	$parasito = new Parasito();
		$parasito->par_nombre = $request->par_nombre;
    	$parasito->par_descripcion = $request->par_descripcion;
    	$parasito->par_clasificacion = $request->par_clasificacion;
	    $parasito->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$parasito],200);
    }

        public function show($par_id){
    	$parasito = Parasito::find($par_id);
	    $parasito->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$parasito],200);
    }

        public function update(Request $request, $par_id){
    	$parasito = Parasito::find($par_id);
		$parasito->par_nombre = $request->par_nombre;
    	$parasito->par_descripcion = $request->par_descripcion;
    	$parasito->par_clasificacion = $request->par_clasificacion;
	    $parasito->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$parasito],200);
    }

        public function destroy($par_id){
        $parasito = Parasito::find($par_id);
        if (!$parasito)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuenta un parásito con ese código.'])],404);
        }
        $parasito->delete();
        return response()->json(['mensaje'=>'registro eliminado correctamente'], 200);
    }
}
