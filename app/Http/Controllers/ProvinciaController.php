<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProvinciaController extends Controller
{
    
    // lista las provincias por departamento
    public function index()
        {
          $provincia =Provincia::all();
            return response()->json(['status'=>'ok',"msg" => "exito",'provincia'=>$provincia],200); 
        }
    // lista las provincias por departamento
    public function pronvicia_departamento($dep_id)
    {
        $provincia=Provincia::where('dep_id', $dep_id)->get();
        return response()->json(['status'=>'ok',"msg" => "exito",'provincia'=>$provincia],200); 
    }
}
