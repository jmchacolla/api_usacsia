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
use App\Models\Ficha;


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
       	if ($request->tra_id) {$persona_tramite->tra_id=$request->tra_id;}
		if ($request->per_id) {$persona_tramite->per_id=$request->per_id;}
		if ($request->pt_numero_tramite) {$persona_tramite->pt_numero_tramite = $request->pt_numero_tramite;}
		if ($request->pt_vigencia_pago) {$persona_tramite->pt_vigencia_pago=$request->pt_vigencia_pago;}
		if ($request->pt_fecha_ini) {$persona_tramite->pt_fecha_ini=$request->pt_fecha_ini;}
		if ($request->pt_fecha_fin) {$persona_tramite->pt_fecha_fin=$request->pt_fecha_fin;}
		if ($request->pt_estado_pago) {$persona_tramite->pt_estado_pago=$request->pt_estado_pago;}
		if ($request->pt_estado_tramite) {$persona_tramite->pt_estado_tramite=$request->pt_estado_tramite;}
		if ($request->pt_monto) {$persona_tramite->pt_monto=$request->pt_monto;}
		if ($request->pt_tipo_tramite) {$persona_tramite->pt_tipo_tramite=$request->pt_tipo_tramite;}
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


        $concluido="CONCLUIDO";
        $vencido="VENCIDO";
        $persona_tramite = Persona_tramite::select('persona_tramite.pt_id','persona_tramite.pt_estado_tramite','per_nombres','per_apellido_primero', 'per_apellido_segundo', 'per_ci', 'per_ci_expedido')
        ->where('persona_tramite.pt_estado_tramite','!=',$concluido)
        ->where('persona_tramite.pt_estado_tramite','!=',$vencido)
        ->join('persona', 'persona.per_id','=', 'persona_tramite.per_id')
        ->where('persona.per_ci', $per_ci)
        ->orderBy('persona_tramite.created_at')
        ->first();

        if ($persona_tramite)
        {    
            $idepersonatramite=$persona_tramite->pt_id;
            $existe=Muestra::select('mue_num_muestra','mue_fecha','persona_tramite.pt_id','pt_numero_tramite','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento')
            ->join('persona_tramite','persona_tramite.pt_id','=','muestra.pt_id')
            ->join('persona','persona.per_id','=','persona_tramite.per_id')
            ->where('muestra.pt_id', $idepersonatramite)
            ->where('muestra.mue_fecha', $hoy)
            ->get();
            if($existe){
                return response()->json(['status'=>'ok','msg'=>"con numero de muestra",'muestra'=>$existe],200); 
            }
        }
        
         return response()->json(['status'=>'ok','msg'=>'sin numero de muestra',"persona_tramite"=>$persona_tramite], 200);
        }


    /*lista de personas que concluyeron el tramite*/
     public function lista_pers_tra()
    {
        /*$hoy=date('Y-m-d');*/
/*      $concluido="CONCLUIDO";
        $vencido="VENCIDO";*/
        $persona_tramite = Persona_tramite::select('persona_tramite.pt_id','persona_tramite.pt_estado_tramite','persona.per_id','per_nombres','per_apellido_primero', 'per_apellido_segundo', 'per_ci', 'per_ocupacion','per_ci_expedido')
        ->where('pt_estado_tramite','CONCLUIDO')
        ->join('persona', 'persona.per_id','=', 'persona_tramite.per_id')
       /* ->join('prueba_medica','prueba_medica.pt_id','=','persona_tramite.pt_id')
        ->where('prueba_medica.estado','OK')
        ->join('prueba_laboratorio','prueba_laboratorio.pt_id','=','persona_tramite.pt_id')
        ->where('prueba_laboratorio.estado','OK')*/
        ->orderBy('persona_tramite.created_at')
        ->get();

        return response()->json(['status'=>'ok','msg'=>'exito',"persona_tramite"=>$persona_tramite], 200);
    }



    public function buscar_persona_tramite_ficha($per_ci)
    {
        $hoy=date('Y-m-d');


        $concluido="CONCLUIDO";
        $vencido="VENCIDO";
        $persona_tramite = Persona_tramite::select('persona_tramite.pt_id','persona_tramite.pt_estado_tramite','per_nombres','per_apellido_primero', 'per_apellido_segundo', 'per_ci', 'per_ci_expedido')
        ->where('persona_tramite.pt_estado_tramite','!=',$concluido)
        ->where('persona_tramite.pt_estado_tramite','!=',$vencido)
        ->join('persona', 'persona.per_id','=', 'persona_tramite.per_id')
        ->where('persona.per_ci', $per_ci)
        ->orderBy('persona_tramite.created_at')
        ->first();

        if ($persona_tramite)
        {    
            $idepersonatramite=$persona_tramite->pt_id;
            $existe=Ficha::select('fic_numero','fic_fecha','persona_tramite.pt_id','pt_numero_tramite','per_ci','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento')
            ->join('persona_tramite','persona_tramite.pt_id','=','ficha.pt_id')
            ->join('persona','persona.per_id','=','persona_tramite.per_id')
            ->where('ficha.pt_id', $idepersonatramite)
            ->where('ficha.fic_fecha', $hoy)
            ->get();
            if($existe){
                return response()->json(['status'=>'ok','msg'=>"con numero de ficha",'ficha'=>$existe],200); 
            }
        }
        
         return response()->json(['status'=>'ok','msg'=>'sin numero de ficha',"persona_tramite"=>$persona_tramite], 200);
        }




}
