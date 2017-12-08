<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

use App\Models\Prueba_medica;

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
		$prueba_medica->ser_id=1;//-----------------------medicina general
		$prueba_medica->fun_id = 2;//-----------------------debe cachearse de sesion
		$prueba_medica->pm_fr=$request->pm_fr;
		$prueba_medica->pm_fc=$request->pm_fc;
		$prueba_medica->pm_peso=$request->pm_peso;
		$prueba_medica->pm_talla=$request->pm_talla;
		$prueba_medica->pm_imc=$request->pm_imc;
		// $prueba_medica->pm_diagnostico=$request->pm_diagnostico;//---se edita al finalizar las pruebas
		$prueba_medica->pm_estado='PENDIENTE';
		$prueba_medica->pm_fecha=$request->pm_fecha;
		$prueba_medica->userid_at='2';
		$prueba_medica->save();

		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","prueba_medica"=>$prueba_medica], 200);

    }

    public function update(Request $request, $pm_id)
    {
       $prueba_medica= Prueba_medica::find($pm_id);
       if (!$prueba_medica)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra una prueba medica con ese código.'])],404);
        }
       	
		$prueba_medica->pt_id=$request->pt_id;
		$prueba_medica->ser_id=$request->ser_id;
		$prueba_medica->fun_id = $request->fun_id;
		$prueba_medica->pm_fr=$request->pm_fr;
		$prueba_medica->pm_fc=$request->pm_fc;
		$prueba_medica->pm_peso=$request->pm_peso;
		$prueba_medica->pm_talla=$request->pm_talla;
		$prueba_medica->pm_imc=$request->pm_imc;
		$prueba_medica->pm_diagnostico=$request->pm_diagnostico;
		$prueba_medica->pm_tipo=$request->pm_tipo;
		$prueba_medica->pm_estado=$request->pm_estado;
		$prueba_medica->pm_fecha=$request->pm_fecha;
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

        $persona_tra=Persona_Tramite::find($pt_id);
        $per_id=$persona_tra->per_id;

        $servicio=Servicio::find($ser_id);
        $prueba_enfermedad=Prueba_Enfermedad::where('prueba_enfermedad.pm_id',$pm_id)->get();

        //$func=Funcionario::find($fun_id);
//saca los datos del funcionario
         $funcionario=Funcionario::select('funcionario.fun_id','fun_cargo','persona.per_id','per_ci','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','per_genero','per_numero_celular','per_tipo_documento','per_pais')
         ->join('persona','persona.per_id','=','funcionario.per_id')->where('funcionario.fun_id','=',$fun_id)->get();

         //saca los datos del paciente
         $paciente=Persona::select('persona.per_id','per_ci','per_ci_expedido','per_nombres','per_apellido_primero','per_apellido_segundo','per_fecha_nacimiento','per_genero','per_numero_celular','per_tipo_documento','per_pais')
        ->where('persona.per_id','=',$per_id)->get();
        
        //saca los datos de enfermedad
        $enfermedad=Enfermedad::select('enfermedad.enfe_id','enfe_nombre','enfe_causas')
         ->join('prueba_enfermedad','prueba_enfermedad.enfe_id','=','enfermedad.enfe_id')
		->where('prueba_enfermedad.pm_id',$pm_id)
         ->get();

         //saca datos de prueba medica
        $prueba_medica=compact('prueba_medica','persona_tra','servicio','funcionario','paciente','prueba_enfermedad','enfermedad');
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

   

}
