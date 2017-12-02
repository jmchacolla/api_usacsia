<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;

class AmbienteController extends Controller
{
    public function index()
    {
    	$ambientes=\App\Models\Ambiente::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','ambiente'=>$ambientes],200); 
    }
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'usa_id' => 'required',
            
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
			$ambientes= new \App\Models\Ambiente();
			$ambientes->usa_id=$request->usa_id;
			$ambientes->amb_nombre = $request->amb_nombre;
			$ambientes->amb_tipo=$request->amb_tipo;
			$ambientes->amb_descripcion=$request->amb_descripcion;
			
			$ambientes->save();

			

			
			
   			return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","ambiente"=>$ambientes], 200);

    }
    

}
