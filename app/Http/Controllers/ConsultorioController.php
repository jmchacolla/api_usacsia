<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use \App\Models\Consultorio;
use \App\Models\Ambiente;

class ConsultorioController extends Controller
{
    
    public function index()
    {
        /*$consultorios=\App\Models\Consultorio::all();
        return response()->json(['status'=>'ok','mensaje'=>'exito','consultorio'=>$consultorios],200); */
        $consultorios= Ambiente::select('ambiente.amb_id','usa_id','amb_nombre','amb_descripcion','consultorio.con_id','con_cod')
        ->join('consultorio','consultorio.amb_id','=','ambiente.amb_id')
        ->where('amb_tipo',"CONSULTORIO")
        ->get();
       
        return response()->json(['status'=>'ok','mensaje'=>'exito','consultorios'=>$consultorios],200); 
   
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
        $consultorios= new \App\Models\Consultorio();
        $consultorios->amb_id=$request->amb_id;
        $consultorios->con_cod=$request->con_cod;
        $consultorios->save();

        
        return response()->json(['status'=>'ok',"mensaje"=>"creado exitosamente","consultorio"=>$consultorios], 200);

    }
    public function crear_ambiente_consultorio(Request $request)
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

         //creando consultorio

        $consultorios= new Consultorio();
        
        $consultorios->amb_id=$ambientes->amb_id;
        $consultorios->con_cod=$request->con_cod;
        $consultorios->userid_at='2';
        $consultorios->save();
         
                
        $resultado=compact('ambientes','consultorios');

        return response()->json([
            'status'=>'ok',
            "msg" => "exito",
            "consultorio" => $resultado
            ], 200
        );

    }

    public function update(Request $request, $amb_id)
    {
       $ambientes= Ambiente::find($amb_id);

       
       if (!$ambientes)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un ambiente con ese código.'])],404);
        }
    
        
        $ambientes->amb_nombre= $request->amb_nombre;
        $ambientes->amb_tipo= $request->amb_tipo;
        $ambientes->amb_descripcion= $request->amb_descripcion;
       /* $ambientes->userid_at='2';*/
        $ambientes->save();

         //creando consultorio

       //$consultorios= \App\Models\Consultorio::find($con_id);


        $consultorio = Consultorio::where('amb_id', $amb_id)->get()->first();
        $con_id=$consultorio->con_id;
        $consultorios= Consultorio::find($con_id);

       
        $consultorios->con_cod=$request->con_cod;
       /* $consultorios->userid_at='2';*/
        $consultorios->save();

       
       $result = compact('ambientes','consultorios');
        return response()->json(['status'=>'ok',"mensaje"=>"editado exitosamente","consultorio"=>$result], 200);
        
    
    }

    public function show($amb_id)
    {
        $ambientes= Ambiente::find($amb_id);
        if (!$ambientes)
        {

            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra el ambiente consultorio con ese código.'])],404);
        }
        
       $consultorios= Consultorio::where('amb_id',$amb_id)->get()->first();
       if (!$consultorios)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un consultorio en el ambiente'])],404);
        }
            //$establecimientos=$establecimientos->toArray();

        $resultado=compact('ambientes','consultorios');
       
        return response()->json(['status'=>'ok','ambiente'=>$resultado],200);
    }

/*    public function listar_consultorios()
    {
        $consultorios=\App\Models\Ambiente::select('ambiente.amb_id','usa_id','amb_nombre','amb_descripcion','consultorio.con_id','con_cod')
        ->join('consultorio','consultorio.amb_id','=','ambiente.amb_id')
        ->get();
       
        return response()->json(['status'=>'ok','mensaje'=>'exito','consultorios'=>$consultorios],200); 
    }*/

    public function destroy($amb_id)
    {
        $ambientes = Ambiente::find($amb_id);

        if (!$ambientes)
        {    
            return response()->json(["mensaje"=>"no se encuentra un ambiente con ese codigo"]);
         }

        $consultorio = Consultorio::where('amb_id', $amb_id)->get()->first();
        $con_id=$consultorio->con_id;
        $consultorios = Consultorio::find($con_id);

        $consultorios->delete();

        $ambientes->delete();

        return response()->json([

            "mensaje" => "eliminado Ambiente Consultorio"
            ], 200
        );
    }
}
