<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class CariesController extends Controller
{
    public function index()
    {
    	$caries=\App\Models\Caries::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','caries'=>$caries],200); 
    }

     public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'enfe_id' => 'required',
            
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
    	$caries = new \App\Models\Caries();
		$caries->enfe_id=$request->enfe_id;
		$caries->pre_id=$request->pre_id;
		$caries->car_nro_pieza=$request->car_nro_pieza;
	
		$caries->save();
		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","carie"=>$caries], 200);
    }

     public function update(Request $request, $car_id)
    {
       $caries= \App\Models\Caries::find($amb_id);
       if (!$ambientes)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un ambiente con ese código.'])],404);
        }
        $ambientes->amb_nombre= $request->amb_nombre;
        $ambientes->amb_tipo= $request->amb_tipo;
        $ambientes->amb_descripcion= $request->amb_descripcion;
       /* $ambientes->userid_at='2';*/
        $ambientes->save();

        $laboratorio = \App\Models\Laboratorio::where('amb_id', $amb_id)->get()->first();
        $lab_id=$laboratorio->lab_id;
        $laboratorios= \App\Models\Laboratorio::find($lab_id);


       
        $laboratorios->fun_id=$request->fun_id;
        $laboratorios->lab_cod=$request->lab_cod;
       /* $consultorios->userid_at='2';*/
        $laboratorios->save();

       
       $result = compact('ambientes','laboratorios');
       return response()->json(['status'=>'ok',"mensaje"=>"editado exitosamente","laboratorio"=>$result], 200);
        
    
    }
}
