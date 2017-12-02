<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Municipio;

class MunicipioController extends Controller
{
   
    // lista las provincias por departamento
    public function index()
        {
            $municipio = Municipio::all();
            return response()->json(['status'=>'ok',"msg" => "exito",'municipio'=>$municipio],200); 
        }
    // lista las municipios por departamento
    public function municipio_provincia($pro_id)
        {
            $municipio = Municipio::where('pro_id', $pro_id)->get();
            return response()->json(['status'=>'ok',"msg" => "exito",'municipio'=>$municipio],200); 
        }
}
