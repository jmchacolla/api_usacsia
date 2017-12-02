<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class Prueba_enfermedadController extends Controller
{
    public function index()
    {
    	$prueba_enfermedad=\App\Models\Prueba_Enfermedad::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','prueba_enfermedad'=>$prueba_enfermedad],200); 
    }
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'pm_id' => 'required',
            'enfe_id' => 'required'
        ]);
        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
		$prueba_enfermedad= new \App\Models\Prueba_Enfermedad();
		$prueba_enfermedad->pm_id=$request->pm_id;
		$prueba_enfermedad->enfe_id=$request->enfe_id;
		$prueba_enfermedad->pre_resultado = $request->pre_resultado;
		$prueba_enfermedad->userid_at='2';
		$prueba_enfermedad->save();

		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","prueba_enfermedad"=>$prueba_enfermedad], 200);

    }

    public function crear_prueba_medica_enfermedad(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'pt_id' => 'required',
            'ser_id' => 'required',
            'fun_id' => 'required',
            
            /*'pm_id' => 'required',*/
            'enfe_id' => 'required'
        ]);
        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
		$prueba_medica= new \App\Models\Prueba_Medica();
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
		$prueba_medica->userid_at='2';
		$prueba_medica->save();

		


		$prueba_enfermedad= new \App\Models\Prueba_Enfermedad();
		$prueba_enfermedad->pm_id=$prueba_medica->pm_id;
		$prueba_enfermedad->enfe_id=$request->enfe_id;
		$prueba_enfermedad->pre_resultado = $request->pre_resultado;
		$prueba_enfermedad->userid_at='2';
		$prueba_enfermedad->save();

		$resultado=compact('prueba_medica','prueba_enfermedad');

		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","consulta"=>$resultado], 200);

    }

     public function destroy($pre_id)
    {
        $prueba_enfermedad = \App\Models\Prueba_Enfermedad::find($pre_id);

        if (!$prueba_enfermedad)
        {    
            return response()->json(["mensaje"=>"no se encuentra una prueba enfermedad con ese codigo"]);
         }

        $prueba_enfermedad->delete();

        return response()->json([
            "mensaje" => "eliminado prueba enfermedad Laboratorio"
            ], 200
        );
    }




}
