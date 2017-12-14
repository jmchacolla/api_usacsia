<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Prueba_par;
use App\Models\Parasito;


class Prueba_parController extends Controller
{
    //
    /*LISTA DE PARASITOS QUE ESTAN EN LA PRUEBA*/
     public function parasitosprueba($pl_id){
    	$prueba_par = Prueba_par::select('pp_id','parasito.par_id','parasito.par_nombre')
        ->join('parasito','parasito.par_id','=', 'prueba_par.par_id')
        ->where('prueba_par.pl_id',$pl_id)
        ->orderby('prueba_par.created_at','DESC')
        ->get(); 
    	return response()->json(['status'=>'ok','mensaje'=>'exito','pruebaparasito'=>$prueba_par],200);
    }

    /*LISTA DE PARASITOS QUE NO ESTAN EN LA PRUEBA*/
    public function parasitos_no_prueba($pl_id){
        $parasitos_asignados=Prueba_par::where('prueba_par.pl_id',$pl_id)->select('par_id')->get();
        $prueba_par = Parasito::select('parasito.par_id','parasito.par_nombre')
        ->whereNotIn('parasito.par_id',$parasitos_asignados)
        ->get();
        
        return response()->json(['status'=>'ok','mensaje'=>'exito','pruebaparasito'=>$prueba_par],200);
    }

        public function store(Request $request){
	    $prueba_par = new Prueba_par();
		$prueba_par->pl_id = $request->pl_id;
    	$prueba_par->par_id = $request->par_id;
    	$prueba_par->pp_resultado = $request->pp_resultado;
	    $prueba_par->save();
	    return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_par'=>$prueba_par],200);
    }

        public function update(Request $request, $par_id){
    	$prueba_par = Prueba_par::find($par_id);
    	$prueba_par->pp_resultado = $request->pp_resultado;
	    $prueba_par->save();

	    return response()->json(['status'=>'ok','mensaje'=>'exito','parasito'=>$prueba_par],200);
    }

    public function destroy($pp_id)
    {
        $pruebaparasito = Prueba_par::find($pp_id);
        if (!$pruebaparasito)
        {    
            return response()->json(["mensaje"=>"no se encuentra un tratamiento con ese codigo"]);
         }

        $pruebaparasito->delete();
        return response()->json([
          'status'=>'ok',
            "mensaje" => "eliminado Prueba Parasito"
            ], 200
        );
    }
}
