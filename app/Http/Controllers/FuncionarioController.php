<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Models\Funcionario;
use App\Models\Persona;
use App\Models\Imagen;
use App\Models\Zona;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Departamento;

class FuncionarioController extends Controller
{
    //listar todos los funcionarios
    public function index()
    {
        /*$funcionario=Funcionario::all();
        return response()->json(['status'=>'ok', 'funcionario'=>$funcionario], 200);*/

        $funcionario = \App\Models\Funcionario::select('persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_ci','funcionario.fun_id','fun_cargo')
            ->join('persona','persona.per_id','=','funcionario.per_id')->orderBy('per_nombres')->get(); 

        return response()->json(['status'=>'ok',"msg" => "exito",'funcionario'=>$funcionario],200); 
    }
    //listar funcionarios por cargo input (MEDICO - ENFERMERA - LABORATORISTA- ADMINISTRATIVO) LOS CARGOS DESCRITOS
    public function listaporcargo($cargo)
    {
        $funcionario=Funcionario::select('funcionario.fun_id','fun_profesion','fun_cargo','fun_estado','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_ci','per_fecha_nacimiento')->join('persona','persona.per_id','=','funcionario.per_id')->where('fun_estado','ACTIVO')->where('fun_cargo','ilike',$cargo)->orderBy('per_nombres')->get();

        return response()->json(['status'=>'ok', 'funcionario'=>$funcionario], 200);
    }

    // crear funcionario cuando la persona no existe
    public function crear_funcionario(Request $request)
    {
        //crear persona
        $persona = new Persona();
        $persona->zon_id=$request->zon_id;
        $persona->per_ci=$request->per_ci;
        $persona->per_tipo_documento= $request->per_tipo_documento;
        $persona->per_pais= $request->per_pais;
        $persona->per_ci_expedido = $request->per_ci_expedido;
        $persona->per_nombres= Str::upper($request->per_nombres);
        $persona->per_apellido_primero= Str::upper($request->per_apellido_primero);
        $persona->per_apellido_segundo= Str::upper($request->per_apellido_segundo);
        $persona->per_fecha_nacimiento= $request->per_fecha_nacimiento;
        $persona->per_genero= $request->per_genero;
        $persona->per_email= $request->per_email;
        $persona->per_numero_celular= $request->per_numero_celular;
        $persona->per_clave_publica= $request->per_clave_publica;
        $persona->per_avenida_calle=$request->per_avenida_calle;
        $persona->per_numero=$request->per_numero;
        $persona->per_ocupacion=$request->per_ocupacion;
        $persona->userid_at='2';
        $persona->save();

        //creando imagen de persona
        $imagen = new Imagen();
        $imagen->per_id=$persona->per_id;
        $imagen->ima_nombre=$request->ima_nombre;
        $imagen->ima_enlace=$request->ima_enlace;
        $imagen->ima_tipo=$request->ima_tipo;
        $imagen->save();
        
        //creando funcionario
        $funcionario = new Funcionario();
        $funcionario->per_id=$persona->per_id;
        $funcionario->fun_profesion=Str::upper($request->fun_profesion);
        $funcionario->fun_cargo=Str::upper($request->fun_cargo);
        $funcionario->save();
        $resultado=compact('persona', 'imagen','funcionario');

         return response()->json(["msg" => "exito", "funcionario" => $resultado], 200);
    }

    //crear funcionario desde persona existente
     public function store(Request $request)

    {
           // $id=JWTAuth::toUser()->id;
             $validator = Validator::make($request->all(), [
                'per_id' => 'required',     
            ]);
            if ($validator->fails()) 
            {
                return $validator->errors()->all();
            } 
        // crear al funcionario si existe la persona
        $funcionarios= new Funcionario();
        $funcionarios->per_id=$request->per_id;
        $funcionarios->fun_profesion=$request->fun_profesion;
        $funcionarios->fun_cargo=$request->fun_cargo;
        $funcionarios->userid_at='2';
        $funcionarios->save();
        $resultado=compact('funcionarios','funcionario_establecimiento','medico','enfermera');
        return response()->json(['status'=>'ok',"msg" => "exito", "funcionario" => $resultado ], 200);
    }
    //detalle de funcionario
    public function mos($fun_id)
       {

            $funcionario=Funcionario::find($fun_id);

            if (!$funcionario){
                return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un funcionario con ese código.'])],404);
               }

            $funcionario=Funcionario::select('funcionario.fun_id','fun_profesion','fun_cargo','fun_estado','persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_ci','per_fecha_nacimiento', 'imagen.ima_id', 'ima_nombre','ima_enlace','ima_tipo', '_zona.zon_nombre', 'municipio.mun_nombre', 'provincia.pro_nombre', 'departamento.dep_nombre')->join('persona','persona.per_id','=','funcionario.per_id')->join('imagen','funcionario.per_id','=','imagen.per_id')->join('_zona','_zona.zon_id','=', 'persona.zon_id')->join('municipio','municipio.mun_id','=','_zona.mun_id')->join('provincia','provincia.pro_id','=','municipio.pro_id')->join('departamento','departamento.dep_id','=','provincia.dep_id')->where('fun_estado','ACTIVO')->where('fun_id',$fun_id)->orderBy('per_nombres')->get();

            return response()->json(['status'=>'ok',"msg" => "exito",'funcionario'=>$funcionario],200); 
        }/**/


 public function show( $fun_id)
    {

    //$es_id=$request->es_id;

    $funcionario=\App\Models\Funcionario::find($fun_id);

    if (!$funcionario)
        {
    return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra un funcionario con ese código.'])],404);
        }


    $funcionario= \App\Models\Funcionario::find($fun_id);

    $per_id=$funcionario->per_id;

    $persona=\App\Models\Persona::find($per_id);

     $zon_id=$persona->zon_id;

    $zona=\App\Models\Zona::find($zon_id);


    $imagen=\App\Models\Imagen::find($per_id);
   // $direccion=\awebss\Models\Direccion::where('per_id',$per_id)->get();

    $resultado=compact('persona','funcionario','zona','imagen');

    return response()->json(['status'=>'ok',"msg" => "exito",'funcionario'=>$resultado],200); 

    
    }

    public function destroy($fun_id)
    {
        $funcionario = \App\Models\Funcionario::find($fun_id);

        if (!$funcionario)
        {    
            return response()->json(["mensaje"=>"no se encuentra una persona_tramite con ese codigo"]);
         }

       
        $persona_tramite->delete();

        return response()->json([

            "mensaje" => "eliminado Persona tramite"
            ], 200
        );
    }
    public function liswen()
    {
        echo "string";
    }


    


}
