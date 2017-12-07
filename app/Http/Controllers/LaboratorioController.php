<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use \App\Models\Ambiente;
use \App\Models\Laboratorio;

class LaboratorioController extends Controller
{
    public function index()
    {
    	$laboratorios=Ambiente::select('ambiente.amb_id','usa_id','amb_nombre','amb_descripcion','laboratorio.lab_id','lab_cod','funcionario.fun_id','fun_cargo','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo')
        ->join('laboratorio','laboratorio.amb_id','=','ambiente.amb_id')
        ->join('funcionario','funcionario.fun_id','=','laboratorio.fun_id')
        ->join('persona','persona.per_id','=','funcionario.per_id')
        ->get();

        return response()->json(['status'=>'ok','mensaje'=>'exito','laborato'=>$laboratorios],200); 
    }
    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
            
            'amb_id' => 'required',
            
        ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
		}  
    	$laboratorios = new Laboratorio();
		$laboratorios->amb_id=$request->amb_id;
		$laboratorios->fun_id=$request->fun_id;
		$laboratorios->lab_cod=$request->lab_cod;
	
		$laboratorios->save();

		
		
		return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","laboratorio"=>$laboratorios], 200);
    }
    public function crear_ambiente_laboratorio(Request $request)
    {
        /*$validator = Validator::make($request->all(), [
            
            'usu_id' => 'required',
            'amb_id' => 'required',
            ]);

        if ($validator->fails()) 
        {
            return $validator->errors()->all();
        }*/
        
        $ambientes = new Ambiente();
        $ambientes->usa_id = $request->usa_id;
        $ambientes->amb_nombre= $request->amb_nombre;
        $ambientes->amb_tipo= $request->amb_tipo;
        $ambientes->amb_descripcion= $request->amb_descripcion;
        $ambientes->userid_at='2';
        $ambientes->save();

         //creando laboratorio

        $laboratorios = Laboratorio();
        $laboratorios->amb_id=$ambientes->amb_id;
        $laboratorios->fun_id=$request->fun_id;
        $laboratorios->lab_cod=$request->lab_cod;
    
        $laboratorios->save();
                
        $resultado=compact('ambientes','laboratorios');

        return response()->json([
            'status'=>'ok',
            "msg" => "exito",
            "laboratorio" => $resultado
            ], 200
        );

    }

    public function update(Request $request, $amb_id)
    {
       $ambientes= \App\Models\Ambiente::find($amb_id);
       if (!$ambientes)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un ambiente con ese código.'])],404);
        }
        $ambientes->amb_nombre= $request->amb_nombre;
        $ambientes->amb_tipo= $request->amb_tipo;
        $ambientes->amb_descripcion= $request->amb_descripcion;
       /* $ambientes->userid_at='2';*/
        $ambientes->save();

        $laboratorio = Laboratorio::where('amb_id', $amb_id)->get()->first();
        $lab_id=$laboratorio->lab_id;
        $laboratorios= Laboratorio::find($lab_id);


       
        $laboratorios->fun_id=$request->fun_id;
        $laboratorios->lab_cod=$request->lab_cod;
       /* $consultorios->userid_at='2';*/
        $laboratorios->save();

       
       $result = compact('ambientes','laboratorios');
       return response()->json(['status'=>'ok',"mensaje"=>"editado exitosamente","laboratorio"=>$result], 200);
        
    
    }

     public function show($amb_id)
    {
        $ambientes= \App\Models\Ambiente::find($amb_id);
        if (!$ambientes)
        {

            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el ambiente consultorio con ese código.'])],404);
        }
        
       $laboratorios= \App\Models\Laboratorio::where('amb_id',$amb_id)->get()->first();
       if (!$laboratorios)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un laboratorio en el ambiente'])],404);
        }
        $fun_id=$laboratorios->fun_id;

        $funcionario=\App\Models\Funcionario::find($fun_id);

        $per_id=$funcionario->per_id;

        $persona=\App\Models\Persona::find($per_id);
            //$establecimientos=$establecimientos->toArray();

        $resultado=compact('ambientes','laboratorios','funcionario','persona');
       
        return response()->json(['status'=>'ok','ambiente'=>$resultado],200);
    }


     
    /*public function listar_laboratorios()
    {
        $laboratorios=\App\Models\Ambiente::select('ambiente.amb_id','usa_id','amb_nombre','amb_descripcion','laboratorio.lab_id','fun_id','lab_cod')
        ->join('laboratorio','laboratorio.amb_id','=','ambiente.amb_id')
        ->get();
       
        return response()->json(['status'=>'ok','mensaje'=>'exito','laborato'=>$laboratorios],200); 
    }*/

    //lista solo laboratorios
     public function listar_laboratorios()
    {
        $laboratorios= Ambiente::select('ambiente.amb_id','usa_id','amb_nombre','amb_descripcion','laboratorio.lab_id','lab_cod','funcionario.fun_id','fun_cargo','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo')
        ->join('laboratorio','laboratorio.amb_id','=','ambiente.amb_id')
        ->join('funcionario','funcionario.fun_id','=','laboratorio.fun_id')
        ->join('persona','persona.per_id','=','funcionario.per_id')
        ->get();
       
        return response()->json(['status'=>'ok','mensaje'=>'exito','laborato'=>$laboratorios],200); 
    }
    public function destroy($amb_id)
    {
        $ambientes = Ambiente::find($amb_id);

        if (!$ambientes)
        {    
            return response()->json(["mensaje"=>"no se encuentra un ambiente con ese codigo"]);
         }

        $laboratorio = \App\Models\Laboratorio::where('amb_id', $amb_id)->get()->first();
        $lab_id=$laboratorio->lab_id;
        $laboratorios = \App\Models\Laboratorio::find($lab_id);

        $laboratorios->delete();

        $ambientes->delete();

        return response()->json([

            "mensaje" => "eliminado Ambiente Laboratorio"
            ], 200
        );
    }

}
