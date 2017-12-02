<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Zona;

class ZonaController extends Controller
{
    public function index($mun_id)
    {
        $zona = Zona::where('mun_id', $mun_id)->get();
        return response()->json(['status'=>'ok','mensaje'=>'exito','zona'=>$zona],200);
    }
}
