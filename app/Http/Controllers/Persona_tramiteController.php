<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class Persona_tramiteController extends Controller
{
    public function listar_x_tipo_tramite($tra_id)
    {
        /*  
            1: lista de tramites de carnet sanitario
            2: lista de tramites de certificado sanitario
        */
        $pers_tramite=Persona_Tramite::select('tramite.tra_nombre', 'persona.per_id','persona.per_ci','persona.per_nombres','persona.per_apellido_primero','persona.per_apellido_segundo','persona.per_fecha_nacimiento', 'persona.per_genero','persona.per_ocupacion','pt_tipo_tramite')
        ->join('tramite','tramite.tra_id','=','persona_tramite.tra_id')
        ->join('persona', 'persona.per_id', '=', 'persona_tramite.per_id')
        ->where('persona_tramite.tra_id', $tra_id)
        ->get();



        return response()->json(['status'=>'ok','mensaje'=>'exito','persona_tramite'=>$pers_tramite],200);
    }

    public function store(Request $request)
    {
		/*$validator = Validator::make($request->all(), [
            
            'tra_id' => 'required',
            'per_id' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  */
		$persona_tramite= new \App\Models\Persona_Tramite();
		$persona_tramite->tra_id=$request->tra_id;
		$persona_tramite->per_id=$request->per_id;
		$persona_tramite->pt_numero_tramite = $request->pt_numero_tramite;
		$persona_tramite->pt_vigencia_pago=$request->pt_vigencia_pago;
		$persona_tramite->pt_fecha_ini=$request->pt_fecha_ini;
		$persona_tramite->pt_fecha_fin=$request->pt_fecha_fin;
		$persona_tramite->pt_estado_pago=$request->pt_estado_pago;
		$persona_tramite->pt_estado_tramite=$request->pt_estado_tramite;
		$persona_tramite->pt_monto=$request->pt_monto;
		$persona_tramite->pt_tipo_tramite=$request->pt_tipo_tramite;

		$persona_tramite->save();

   		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","persona_tramite"=>$persona_tramite], 200);

    }

    public function update(Request $request, $pt_id)
    {
       $persona_tramite= \App\Models\Persona_Tramite::find($pt_id);

       
       if (!$persona_tramite)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un ambiente con ese código.'])],404);
        }
       // $ambiente = \App\Models\Ambiente::where('usa_id', $usa_id)->get()->first();
       // $amb_id=$ambiente->amb_id;
        //$ambientes= \App\Models\Ambiente::find($amb_id);
        
       	$persona_tramite->tra_id=$request->tra_id;
		$persona_tramite->per_id=$request->per_id;
		$persona_tramite->pt_numero_tramite = $request->pt_numero_tramite;
		$persona_tramite->pt_vigencia_pago=$request->pt_vigencia_pago;
		$persona_tramite->pt_fecha_ini=$request->pt_fecha_ini;
		$persona_tramite->pt_fecha_fin=$request->pt_fecha_fin;
		$persona_tramite->pt_estado_pago=$request->pt_estado_pago;
		$persona_tramite->pt_estado_tramite=$request->pt_estado_tramite;
		$persona_tramite->pt_monto=$request->pt_monto;
		$persona_tramite->pt_tipo_tramite=$request->pt_tipo_tramite;
       /* $ambientes->userid_at='2';*/
        $persona_tramite->save();

      
     
        return response()->json(['status'=>'ok',"mensaje"=>"editado exitosamente","persona_tramite"=>$persona_tramite], 200);
         
    }

     public function show($pt_id)
    {
        $persona_tramite= \App\Models\Persona_Tramite::find($pt_id);
        if (!$persona_tramite)
        {

            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la persona_tramite con ese código.'])],404);
        }
  
       
        return response()->json(['status'=>'ok','persona_tramite'=>$persona_tramite],200);
    }
     public function destroy($pt_id)
    {
        $persona_tramite = \App\Models\Persona_Tramite::find($pt_id);

        if (!$persona_tramite)
        {    
            return response()->json(["mensaje"=>"no se encuentra una persona_tramite con ese codigo"]);
         }

       
        $persona_tramite->delete();

        return response()->json([

            "mensaje" => "eliminado Persona tramite"
            ], 200
        );
    }

}
