<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use Illuminate\Support\Str;


use App\Models\Prueba_medica;
use App\Models\Persona_tramite;
use App\Models\Servicio;
use App\Models\Prueba_enfermedad;
use App\Models\Funcionario;
use App\Models\Persona;
use App\Models\Enfermedad;

class Prueba_medicaController extends Controller
{
    public function index()
    {
    	$prueba_medica=Prueba_medica::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_medica'=>$prueba_medica],200); 
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'pt_id' => 'required',
            'ser_id' => 'required',
            'fun_id' => 'required'
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
		$prueba_medica= new Prueba_medica();
		$prueba_medica->pt_id=$request->pt_id;
		$prueba_medica->ser_id=$request->ser_id;//-----------------------medicina general
		$prueba_medica->fun_id = $request->fun_id;//-----------------------debe cachearse de sesion
		$prueba_medica->pm_fr=$request->pm_fr;
		$prueba_medica->pm_fc=$request->pm_fc;
        $prueba_medica->pm_pa_sistolica=$request->pm_pa_sistolica;
        $prueba_medica->pm_pa_diastolica=$request->pm_pa_diastolica;
		$prueba_medica->pm_peso=$request->pm_peso;
		$prueba_medica->pm_talla=$request->pm_talla;
		$prueba_medica->pm_imc=$request->pm_imc;
        $prueba_medica->pm_temperatura=$request->pm_temperatura;
		// $prueba_medica->pm_diagnostico="";//---se edita al finalizar las pruebas
		$prueba_medica->pm_estado='PENDIENTE';
		// $prueba_medica->pm_fecha=$request->pm_fecha;
		$prueba_medica->userid_at=2;
		$prueba_medica->save();
        $pm_id=$prueba_medica->pm_id;

        $enfermedades= Enfermedad::all();
        if (!$enfermedades) {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'Debe registrar enfermedades'])],404);
        }
        foreach ($enfermedades as $enfermedad) {
            
            $pruebaenfermedad=new Prueba_enfermedad();
            $pruebaenfermedad->enfe_id=$enfermedad->enfe_id;
            $pruebaenfermedad->pm_id=$pm_id;
            $pruebaenfermedad->pre_resultado=false;
            $pruebaenfermedad->save();
        }
        $pruebas=Prueba_enfermedad::where('prueba_enfermedad.pm_id',$pm_id)->get();
        // $prmed=Prueba_medica::find($pm_id);
        $resultado=compact('prueba_medica', 'pruebas');

		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","prueba_medica"=>$resultado], 200);

    }

    public function update(Request $request, $pm_id)
    {
       $prueba_medica= Prueba_medica::find($pm_id);
       if (!$prueba_medica)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una prueba medica con ese código.'])],404);
        }
       	
		if($request->pt_id){
        $prueba_medica->pt_id=$request->pt_id;
        }
		if($request->ser_id){
        $prueba_medica->ser_id=$request->ser_id;
        }
		if($request->fun_id){
        $prueba_medica->fun_id = $request->fun_id;
        }
		if($request->pm_fr){
        $prueba_medica->pm_fr=$request->pm_fr;
        }
		if($request->pm_fc){
        $prueba_medica->pm_fc=$request->pm_fc;
        }
        if($request->pm_pa_sistolica){
        $prueba_medica->pm_pa_sistolica=$request->pm_pa_sistolica;
        }
        if($request->pm_pa_diastolica){
        $prueba_medica->pm_pa_diastolica=$request->pm_pa_diastolica;
        }
        if($request->pm_peso){
        $prueba_medica->pm_peso=$request->pm_peso;
        }
		if($request->pm_peso){
        $prueba_medica->pm_peso=$request->pm_peso;
        }
		if($request->pm_talla){
        $prueba_medica->pm_talla=$request->pm_talla;
        }
		if($request->pm_imc){
        $prueba_medica->pm_imc=$request->pm_imc;
        }
        if($request->pm_temperatura){
        $prueba_medica->pm_temperatura=$request->pm_temperatura;
        }
		if($request->pm_diagnostico){
        $prueba_medica->pm_diagnostico=Str::upper($request->pm_diagnostico);
        }

		if($request->pm_estado){
        $prueba_medica->pm_estado=Str::upper($request->pm_estado);
        }
		if($request->pm_fecha){
        $prueba_medica->pm_fecha=$request->pm_fecha;
        }
		/*$prueba_medica->userid_at='2';*/
		$prueba_medica->save();



        return response()->json(['status'=>'ok',"mensaje"=>"editado exitosamente","prueba_medica"=>$prueba_medica], 200);
        
    
    }
    public function show($pm_id)
    {
        $prueba_medica= Prueba_medica::find($pm_id);
        if (!$prueba_medica)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la prueba medica con ese código.'])],404);
        }
        $pt_id=$prueba_medica->pt_id;
        $ser_id=$prueba_medica->ser_id;
        $fun_id=$prueba_medica->fun_id;

        $persona_tra=Persona_tramite::find($pt_id);
        if (!$persona_tra)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el trámite con ese código.'])],404);
        }
        $per_id=$persona_tra->per_id;

        $servicio=Servicio::find($ser_id);


        //$func=Funcionario::find($fun_id);
//saca los datos del funcionario
         $funcionario=Funcionario::select('funcionario.fun_id','fun_cargo','persona.per_id','per_ci','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','per_genero','per_numero_celular','per_tipo_documento','per_pais')
         ->join('persona','persona.per_id','=','funcionario.per_id')->where('funcionario.fun_id','=',$fun_id)->first();

         //saca los datos del paciente
         $paciente=Persona::select('persona.per_id','per_ci','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','per_genero','per_numero_celular','per_tipo_documento','per_pais', 'per_ocupacion')
        ->where('persona.per_id','=',$per_id)->first();
        
        //saca los datos de enfermedad
  //       $enfermedad=Enfermedad::select('enfermedad.enfe_id','enfe_nombre','enfe_causas')
  //        ->join('prueba_enfermedad','prueba_enfermedad.enfe_id','=','enfermedad.enfe_id')
		// ->where('prueba_enfermedad.pm_id',$pm_id)
  //        ->get();
        $pruebas=Prueba_enfermedad::where('prueba_enfermedad.pm_id',$pm_id)
        ->join('enfermedad','enfermedad.enfe_id', '=', 'prueba_enfermedad.enfe_id')
        ->orderby('enfermedad.enfe_id')
        ->get();
         //saca datos de prueba medica
        $prueba_medica=compact('prueba_medica','persona_tra','servicio','funcionario','paciente','pruebas');
       return response()->json(['status'=>'ok','prueba_medica'=>$prueba_medica],200);
    }

     
    public function destroy($pm_id)
    {
        $prueba_medica=Prueba_medica::find($pm_id);


         if (!$prueba_medica)
        {

            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una prueba medica con ese código.'])],404);
        }

        $prueba_enfermedad=Prueba_Enfermedad::where('pm_id',$pm_id)->get();

        foreach ($prueba_enfermedad as $enfermedad) {

            $pre_id=$enfermedad->pre_id;
			$enfermedad->delete();
        }

        $prueba_medica->delete();


        return response()->json([ "mensaje" => "registros eliminados correctamente" ], 200);
    }
     

     //ver las enfermedades de una prueba medica
     public function listar_enfermedades_prueba($pm_id)
    {

    	$pruebas=Prueba_Enfermedad::select('prueba_enfermedad.pre_id','pre_resultado','enfermedad.enfe_id','enfe_nombre'/*,'per_id','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo'*/)
		//->join('prueba_enfermedad','prueba_enfermedad._id','=','prueba_enfermedad.enfe_id')
        ->join('enfermedad','enfermedad.enfe_id','=','prueba_enfermedad.enfe_id')

        ->where('prueba_enfermedad.pm_id','=',$pm_id)
        /*
        ->join('funcionario','funcionario.fun_id','=','prueba_medica.fun_id')
        ->join('persona','persona.per_id','=','funcionario.per_id')*/
        ->get();
       
        return response()->json(['status'=>'ok','mensaje'=>'exito','laborato'=>$pruebas],200); 
    }
    public function returnestado($pm_id)
    {
        $estadoprueebas=Prueba_enfermedad::where('prueba_enfermedad.pm_id',$pm_id);
        $estado=false;
    }
    //retorna todas la pruebas medicas de una persona 
    public function pruebamedicapersona($per_ci)
    {
        // $persona=Persona::where('per_ci', $per_ci)->get();
        // $pertramite=Persona_tramite::where('per_id','persona.per_id')->get();
        $listapruebas=Prueba_medica::select('prueba_medica.pm_id', 'prueba_medica.pm_fecha','prueba_medica.pm_diagnostico')
        ->join('persona_tramite','prueba_medica.pt_id','=', 'persona_tramite.pt_id')
        ->join('persona', 'persona_tramite.per_id', '=', 'persona.per_id')
        ->where( 'persona.per_ci','=', $per_ci)
        ->get();
        
        // if (!$listatramitescas) {
        //     return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra tramites con ese CI.'])],404);
        // }
        return response()->json(['status'=>'ok','mensaje'=>'exito','pruebas'=>$listapruebas],200); 
    }
   

}
