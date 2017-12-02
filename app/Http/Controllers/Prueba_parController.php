<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Prueba_par;


class Prueba_parController extends Controller
{
    //
     public function index(){
    	$prueba_par = Prueba_par::all();
    	return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par],200);
    }

        public function store(Request $request){
	    $prueba_par = new Prueba_par();
		$prueba_par->pl_id = $request->pl_id;
    	$prueba_par->par_id = $request->par_id;
    	$prueba_par->pp_resultado = $request->pp_resultado;
	    $prueba_par->save();
	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_par'=>$prueba_par],200);
    }

        public function show($par_id){
    	$parasito = Prueba_par::find($par_id);
	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par],200);
    }

       
        public function update(Request $request, $par_id){
    	$prueba_par = Prueba_par::find($par_id);
    	$prueba_par->pp_resultado = $request->pp_resultado;
	    $prueba_par->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par],200);
    }
}
