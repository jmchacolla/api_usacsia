<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DepartamentoController extends Controller
{
    //
    //Lista departamentos
    
     public function index()
    {
        $departamento=\App\Models\Departamento::all();

         return response()->json(['status'=>'ok','mensaje'=>'exito','departamento'=>$departamento],200); 
    }
}
