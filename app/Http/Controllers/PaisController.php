<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Pais;

class PaisController extends Controller
{
     public function index()
    {
        $pais=Pais::all();

         return response()->json(['status'=>'ok','mensaje'=>'exito','pais'=>$pais],200); 
    }
     public function store(Request $request){
        $pais = new Pais();
        $pais->nac_nombre=$request->nac_nombre;
        $pais->nac_capital=$request->nac_capital;
        $pais->nac_continente=$request->nac_continente;
        $pais->save();

            return response()->json(['status'=>'ok','pais'=> $pais],200);
     }
}
