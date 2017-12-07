<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Models\Persona;
use App\Models\Imagen;
use App\Models\Zona;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Departamento;
class PersonaController extends Controller
{
    //listar todas las personas
    public function index()
    {
        $persona=Persona::all();
        return response()->json(['status'=>'ok','persona'=> $persona],200);
    }
    //crear persona
    public function store(Request $request)
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
        
        $resultado=compact('persona', 'imagen');

         return response()->json(["msg" => "exito", "persona" => $resultado], 200);
    }
    //editar persona
    public function update(Request $request, $per_id)
    {
        
        //busca a la persona por per_id
         $persona = Persona::find($per_id);
          if (!$persona)
         {
             return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la persona con ese código.'])],404);
         }

         // modifica los datos de la persona
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

         // busca imagen
         $imagenes = Imagen::where('per_id', $per_id)->get()->first();
         $ima_id=$imagenes->ima_id;

         // editando los campos de la imagen
         $imagen = Imagen::find($ima_id);
         $imagen->ima_nombre=$request->ima_nombre;
         $imagen->ima_enlace=$request->ima_enlace;
         $imagen->ima_tipo=$request->ima_tipo;
         $imagen->save();
         $resultado=compact('personas','imagen');

          return response()->json(["msg" => "exito","persona" => $resultado], 200);
    }
    //detalle de persona
    public function show($per_id)
    {

        $persona=Persona::find($per_id);

        if (!$persona)
            {
                return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra la persona con ese código.'])],404);
            }
        $imagen = Imagen::where('per_id', $per_id)->get();
        
        $zona= Zona::find($persona->zon_id);
        $municipio=Municipio::find($zona->mun_id);
        $provincia = Provincia::find($municipio->pro_id);
        $departamento = Departamento::find($provincia->dep_id);
        $result = compact('persona','imagen','zona','municipio' ,'provincia','departamento');
        return response()->json(['mensaje'=>'exito','persona'=>$result],200); 

    }
    // busca a un paciente deacuerdo a su numero de carnet devuelve un array

     public function buscar_persona($per_ci)
    {
        $persona= Persona::where('per_ci',$per_ci)/*->whereNull('paciente.deleted_at')*/->select('persona.per_id','per_nombres','per_apellido_primero','per_apellido_segundo','per_ci','per_fecha_nacimiento','per_email','per_numero_celular')->get()->first();

        return response()->json(['mensaje'=>'exito','persona'=>$persona],200); 
    }



        //eliminar persona
    public function destroy($per_id)
        {
            $persona = Persona::find($per_id);

            if (!$persona)
            {    
                return response()->json(["mensaje"=>"no se encuentra una persona con ese codigo"]);
             }

            $persona->delete();

            return response()->json([

                "mensaje" => "eliminado persona"
                ], 200
            );
        }


 




}
