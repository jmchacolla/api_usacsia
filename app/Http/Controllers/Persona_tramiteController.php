<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\Models\Persona_tramite;
use App\Models\Muestra;
use App\Models\Tramite;
use App\Models\Persona;
use App\Models\Imagen;
use App\Models\Zona;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Departamento;


class Persona_tramiteController extends Controller
{
    public function listar_x_tipo_tramite($tra_id)
    {
        /*  
            1: lista de tramites de carnet sanitario
            2: lista de tramites de certificado sanitario
        */
        $pers_tramite=Persona_tramite::select('tramite.tra_nombre', 'persona.per_id','persona.per_ci','persona.per_nombres','persona.per_apellido_primero','persona.per_apellido_segundo','persona.per_fecha_nacimiento', 'persona.per_genero','persona.per_ocupacion','pt_tipo_tramite')
        ->join('tramite','tramite.tra_id','=','persona_tramite.tra_id')
        ->join('persona', 'persona.per_id', '=', 'persona_tramite.per_id')
        ->where('persona_tramite.tra_id', $tra_id)
        ->get();
        return response()->json(['status'=>'ok','mensaje'=>'exito','persona_tramite'=>$pers_tramite],200);
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'tra_id' => 'required',
            'per_id' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
		$persona_tramite= new Persona_tramite();
		$persona_tramite->tra_id=$request->tra_id;
		$persona_tramite->per_id=$request->per_id;
		// $persona_tramite->pt_numero_tramite = $request->pt_numero_tramite;
		$persona_tramite->pt_vigencia_pago=$request->pt_vigencia_pago;
		// $persona_tramite->pt_fecha_ini=$request->pt_fecha_ini;
		$persona_tramite->pt_fecha_fin=$request->pt_fecha_fin;
		// $persona_tramite->pt_estado_pago=$request->pt_estado_pago;
		// $persona_tramite->pt_estado_tramite=$request->pt_estado_tramite;
     /*VERIFICAR SI ES TRAMITE NUEVO O RENOVACION*/
		$persona_tramite->pt_monto=$request->pt_monto;
        $conteo=Persona_tramite::where('per_id', $persona_tramite->per_id)
        ->where('tra_id', $persona_tramite->tra_id)
        ->where('pt_estado_tramite', 'CONCLUIDO')
        ->count();
        if ($conteo>=1) { $persona_tramite->pt_tipo_tramite='RENOVACION';}
        else{$persona_tramite->pt_tipo_tramite='NUEVO';}
		$persona_tramite->save();

   		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","persona_tramite"=>$persona_tramite], 200);

    }

    public function update(Request $request, $pt_id)
    {
       $persona_tramite= Persona_tramite::find($pt_id);

       
       if (!$persona_tramite)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un ambiente con ese código.'])],404);
        }

        
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
        $persona_tramite= Persona_tramite::find($pt_id);
        // $today=Carbon::now();
        // $persona->edad=$today-$persona->per_fecha_nacimiento;
        if (!$persona_tramite)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la persona_tramite con ese código.'])],404);
        }
        $tramite=Tramite::find($persona_tramite->tra_id);
        $persona=Persona::find($persona_tramite->per_id);
        $imagen=Imagen::where('per_id', $persona->per_id)->get();
        $zon_id=$persona->zon_id;
        $zona=Zona::find($zon_id);
        $municipio=Municipio::find($zona->mun_id);
        $provincia=Provincia::find($municipio->mun_id);
        $departamento=Departamento::find($provincia->dep_id);
        $resultado=compact('persona_tramite', 'persona','imagen','zona', 'municipio', 'provincia','departamento', 'tramite');
        return response()->json(['status'=>'ok','pertramite'=>$resultado],200);
    }
     public function destroy($pt_id)
    {
        $persona_tramite = Persona_tramite::find($pt_id);

        if (!$persona_tramite)
        {    
            return response()->json(["mensaje"=>"no se encuentra una persona_tramite con ese codigo"]);
         }
        $persona_tramite->delete();

        return response()->json(["mensaje" => "eliminado Persona tramite"], 200);
    }
    /*BUSCAR PERSONA TRAMITE POR CI*/
     public function buscar_persona_tramite($per_ci)
    {
        $hoy=date('Y-m-d');
        $ultima_muestra=Muestra::select('muestra.mue_num_muestra')
        ->where('muestra.mue_fecha', $hoy)
        ->max('muestra.mue_num_muestra');

        $numero_muestra=$ultima_muestra+1;
        if(!$ultima_muestra)
        {
            $numero_muestra=1;
        } 
        $persona_tramite = Persona_tramite::select('persona_tramite.pt_id','per_nombres','per_apellido_primero', 'per_apellido_segundo', 'per_ci', 'per_ci_expedido','mue_num_muestra')
        ->join('persona', 'persona.per_id','=', 'persona_tramite.per_id')
        ->join('muestra', 'muestra.pt_id',"=", 'persona_tramite.pt_id')
        ->where('persona.per_ci', $per_ci)
        ->get()->first();
        if (!$persona_tramite->first())
        {    
            return response()->json(["mensaje"=>"No se encuentra una persona_tramite con ese codigo"]);
        } 
        $res=compact('numero_muestra','persona_tramite');
         return response()->json(['status'=>'ok','mensaje'=>'exito',"res"=>$res], 200);
    }


}
