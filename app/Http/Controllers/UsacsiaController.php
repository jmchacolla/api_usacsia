<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Model\Usacsia;


class UsacsiaController extends Controller
{
    //

	 public function index()
    {
         $usacsia = Usacsia::all();

    return response()->json(['status'=>'ok',"msg"=>"exito",'usacsia'=>$usacsia], 200);
    }

    public function store(Request $request) 
    {
         $usacsia = new Usacsia();
         $usacsia->usa_nombre=$request->usa_nombre;
         $usacsia->usa_fecha_inicio_actividad=$request->usa_fecha_inicio_actividad;
         $usacsia->usa_zona_localidad_comuni = $request->usa_zona_localidad_comuni;
         $usacsia->usa_avenida_calle=$request->usa_avenida_calle;
         $usacsia->usa_numero=$request->usa_numero;
         $usacsia->usa_inicio_atencion=$request->usa_inicio_atencion;
         $usacsia->usa_final_atencion=$request->usa_final_atencion;
         $usacsia->usa_latitud=$request->usa_latitud;
         $usacsia->usa_longitud=$request->usa_longitud;
         $usacsia->usa_altitud= $request->usa_altitud;
         $usacsia->usa_codigo=$request->usa_codigo;
         $usacsia->usa_fax=$request->usa_fax;
         $usacsia->usa_correo_electronico=$request->usa_correo_electronico;
         $usacsia->usa_direccion_web=$request->usa_direccion_web;
         $usacsia->usa_fecha_creacion=$request->usa_fecha_creacion;
         $usacsia->usa_municipio=$request->usa_municipio;
         $usacsia->usa_provincia=$request->usa_provincia;
         $usacsia->usa_departamento=$request->usa_departamento;
        $usacsia->save();
         return response()->json([
                "msg" => "exito",
                "usa_id" => $usacsia->usa_id
            ], 200
        );

      //  $personas=Modulos/Persona::create($request->all());

    }
    public function update(Request $request, $usa_id)
    {
    	
    	 $usacsia = Usacsia::find($usa_id);
         $usacsia->usa_nombre=$request->usa_nombre;
         $usacsia->usa_fecha_inicio_actividad=$request->usa_fecha_inicio_actividad;
         $usacsia->usa_zona_localidad_comuni = $request->usa_zona_localidad_comuni;
         $usacsia->usa_avenida_calle=$request->usa_avenida_calle;
         $usacsia->usa_numero=$request->usa_numero;
         $usacsia->usa_inicio_atencion=$request->usa_inicio_atencion;
         $usacsia->usa_final_atencion=$request->usa_final_atencion;
         $usacsia->usa_latitud=$request->usa_latitud;
         $usacsia->usa_longitud=$request->usa_longitud;
         $usacsia->usa_altitud= $request->usa_altitud;
         $usacsia->usa_codigo=$request->usa_codigo;
         $usacsia->usa_fax=$request->usa_fax;
         $usacsia->usa_correo_electronico=$request->usa_correo_electronico;
         $usacsia->usa_direccion_web=$request->usa_direccion_web;
         $usacsia->usa_fecha_creacion=$request->usa_fecha_creacion;
         $usacsia->usa_municipio=$request->usa_municipio;
         $usacsia->usa_provincia=$request->usa_provincia;
         $usacsia->usa_departamento=$request->usa_departamento;
         $usacsia->save();



        //editar el telefonos de usacsia
        $telefono = \App\Models\Telefono::where('usa_id',$usa_id)->get()->first();
        
        $telefonos= \App\Models\Telefono::find($telefono->tel_id);
        $telefonos->tel_numero=$request->tel_numero;
        $telefonos->save();

         $result = compact('usacsia','telefono');
         return response()->json([
            "status" => "succes",
            "mensaje" => "editado exitosamente",
            'usacsia' => $result
            ], 200
        );
    }

    public function destroy($usa_id)
    {
    	$usacsia = \awebss\Models\Usacsia::find($usa_id);
    	$usacsia->delete();

    	return response()->json([
    		"msg" => "exito"
    		], 200
    	);
    }

    
}
