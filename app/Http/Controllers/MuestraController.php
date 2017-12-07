<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Muestra;

class MuestraController extends Controller
{
    //
    public function store(Requests $request)
    {
        $muestra =new Muestra();
        $muestra->pt_id=$muestra->pt_id;
        $muestra->mue_num_muestra=$muestra->pt_id;

        return response()->json(['status'=>'ok',"msg" => "exito",'municipio'=>$municipio],200); 
    }
}
