<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Servicio;

class ServicioController extends Controller
{
    //
    public function index()
    {
        $servicio=Servicio::all();

         return response()->json(['status'=>'ok','mensaje'=>'exito','servicio'=>$servicio],200); 
    }
}
