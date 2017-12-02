<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Enfermedad_tratamiento;
use App\Models\Enfermedad;
use App\Models\Tratamiento;

class Enfermedad_tratamientoController extends Controller
{
    //

/*desde el front tiene que llegar al ruta*/
    public function store(Request $request)
    {
       
        $enfermedad = new Enfermedad();
  	    $enfermedad->enfe_nombre = $request->enfe_nombre;
  	    $enfermedad->enfe_causas = $request->enfe_causas;
  	    $enfermedad->enfe_descripcion= $request->enfe_descripcion;
  	    $enfermedad->enfe_prevencion =$request->enfe_prevencion ;
  	    $enfermedad->enfe_necesita_ref = $request->enfe_necesita_ref ;
  	    $enfermedad->save();

        $tratamiento = new Tratamiento();
  		  $tratamiento->trat_nombre=$request->trat_nombre;
  		  $tratamiento->trat_dosis=$request->trat_dosis;
  		  $tratamiento->trat_descripcion=$request->trat_descripcion;
  	    $tratamiento->save();
          
        $enfermedad_tratamiento= new Enfermedad_tratamiento();
        $enfermedad_tratamiento->enfe_id=$enfermedad->enfe_id;
        $enfermedad_tratamiento->trat_id =$tratamiento->trat_id;
        $enfermedad_tratamiento->save();

        $resultado=compact('enfermedad', 'tratamiento','enfermedad_tratamiento');
        return response()->json(['status'=>'ok','mensaje'=>'exito','enfermedad_tratamiento'=>$resultado],200);
    }

   //listar los tratamientos de una enfermedad enfe_id

   public function show($enfe_id)
    {
        
     $enfermedad_tratamiento =where('enfermedad_tratamiento.enfe_id',$enfe_id)->get();

      // Enfermedad_tratamiento::join('tratamiento','tratamiento.enfe_id','=','enfermedad_tratamiento.enfe_id')->select('consultorio.con_id','con_nombre','con_tipo','con_descripcion')->whereNull('consultorio.deleted_at')->where('servicio_consultorio.sc_id',$sc_id)->get();

     	
    
        return response()->json(['status'=>'ok',"msg" => "exito",'enfermedad_tratamiento'=>$enfermedad_tratamiento],200);

    } 


}
