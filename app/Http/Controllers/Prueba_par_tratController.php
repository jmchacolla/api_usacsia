<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Prueba_par_trat;

class Prueba_par_tratController extends Controller
{
    //
	 public function index(){
    	$prueba_par_trat = Prueba_par_trat::all();
    	return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par_trat],200);
    }

        public function store(Request $request){
    	$prueba_par_trat = new Prueba_par_trat();
		$prueba_par_trat->pp_id = $request->pp_id;
		$prueba_par_trat->trat_id = $request->trat_id;
		$prueba_par_trat->ppt_fecha_emision = $request->ppt_fecha_emision;
		$prueba_par_trat->ppt_url_constancia = $request->ppt_url_constancia;
		$prueba_par_trat->ppt_fecha_constancia = $request->ppt_fecha_constancia;
	    $prueba_par_trat->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par_trat],200);
    }

        public function show($ppt_id){
    	$prueba_par_trat = Prueba_par_trat::find($ppt_id);
	    $prueba_par_trat->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_par_trat'=>$prueba_par_trat],200);
    }

        public function update(Request $request, $ppt_id){
    	$prueba_par_trat = Prueba_par_trat::find($ppt_id);
		$prueba_par_trat->ppt_fecha_emision = $request->ppt_fecha_emision;
		$prueba_par_trat->ppt_url_constancia = $request->ppt_url_constancia;
		$prueba_par_trat->ppt_fecha_constancia = $request->ppt_fecha_constancia;
	    $prueba_par_trat->save();
	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par_trat],200);
    }

}
