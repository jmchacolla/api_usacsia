<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresa=\App\Models\Empresa::all();

        return response()->json(['status'=>'ok','mensaje'=>'exito','empresa'=>$empresa],200); 
    }
}
