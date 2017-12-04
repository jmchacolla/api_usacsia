<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Http\Requests;
use App\Models\Horario;
use App\Models\Persona;
use App\Models\Funcionario;
use App\Models\Ambiente;
use App\Models\Consultorio;

class HorarioController extends Controller
{
    //
    public function index()
    {

        $fecha=Carbon::now();
        $horario=Horario::select('horario.hor_id','hor_fecha_in','hor_fecha_fin','funcionario.fun_id','persona.per_id','per_nombres','per_apellido_primero', 'ambiente.amb_id', 'consultorio.con_id','consultorio.con_cod','servicio.ser_id','ser_nombre')
        ->join('funcionario','funcionario.fun_id','=','horario.fun_id')
        ->join('persona','persona.per_id','=','funcionario.per_id')
        ->join('ambiente','ambiente.amb_id','=','horario.amb_id')
        ->join('servicio','servicio.ser_id','=','horario.ser_id')
        ->join('consultorio', 'ambiente.amb_id', '=', 'consultorio.amb_id')
        ->where('horario.hor_fecha_fin','>=', $fecha)
        ->get();
        if ($horario) {
            # code...
          return response()->json(['status'=>'ok','mensaje'=>'exito','horario'=>$horario],200);
        }
        return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el registro'])],404);


    }

        //input ser_id, amb_id, fun_id, hor_fecha_inicio, hor_fecha_final
       public function store(Request $request)
       {
            //$id=JWTAuth::toUser()->id;
            /*$validator = Validator::make($request->all(), [

                'fe_id' => 'required',
                'sc_id' => 'required',
                'ch_fecha_inicio'=>'required',
                'ch_fecha_final'=>'required',
            ]);
           if ($validator->fails()) 
           {
                return $validator->errors()->all();
           }*/
           $horario = new Horario();
           $horario->ser_id=$request->ser_id;
           $horario->amb_id=$request->amb_id;
           $horario->fun_id=$request->fun_id;
           $horario->hor_fecha_inicio=$request->hor_fecha_inicio;
           $horario->hor_fecha_final=$request->hor_fecha_final;
           $horario->userid_at='2';
           $horario->save();


           return response()->json(['status'=>'ok','mensaje'=>'exito','horario'=>$horario],200); 

           $configuracionturno=new ConfiguracionTurno();
           
       }
}
 