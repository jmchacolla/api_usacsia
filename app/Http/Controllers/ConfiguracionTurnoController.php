<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\ConfiguracionTurno;
use App\Models\Horario;


class ConfiguracionTurnoController extends Controller
{
    //listar turno por funcionario
    public function lista($hor_id)
    {
    
        # code...
        
        // $turno=ConfiguracionTurno::where('hor_id', $hor_id)->get();
        $turno=Horario::with('configuracionturno')->find($hor_id);
        return response()->json([ 'status'=>'ok', 'turno'=>$turno], 200);
        // return response()->json(["msg" => "exito", "funcionario" => $resultado], 200);
    }
}
