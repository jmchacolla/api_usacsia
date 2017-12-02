<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TramiteController extends Controller
{
     public function index()
    {
    	$tramites=\App\Models\Tramite::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','tramites'=>$tramites],200); 
    }
    public function show($tra_id)
    {
        $tramites= \App\Models\Tramite::find($tra_id);
        if (!$tramites)
        {
			return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el tramite con ese código.'])],404);
        }
       
        return response()->json(['status'=>'ok','tramite'=>$tramites],200);
    }
}
