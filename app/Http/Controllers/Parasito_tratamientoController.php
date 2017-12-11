<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Parasito;
use App\Models\Tratamiento;
use App\Models\Parasito_tratamiento;

class Parasito_tratamientoController extends Controller
{
    //
  public function store(Request $request)
    {
                
        $parasito_tratamiento= new Parasito_tratamiento();
        $parasito_tratamiento->par_id=$request->par_id;
        $parasito_tratamiento->trat_id =$request->trat_id;
        $parasito_tratamiento->save();

        $resultado=compact('parasito', 'tratamiento','parasito_tratamiento');
        return response()->json(['status'=>'ok','mensaje'=>'exito','parasito_tratamiento'=>$resultado],200);
    }


      //listar los tratamientos de una parasito par_id
  public function tratamientos_x_parasito($par_id){
    $parasito_tratamiento = Parasito::
    select('pt_id','parasito.par_id','trat_nombre', 'trat_dosis','trat_descripcion')    
    ->join('parasito_tratamiento','parasito_tratamiento.par_id','=','parasito.par_id')
    ->join('tratamiento','tratamiento.trat_id','=','parasito_tratamiento.trat_id')
    ->where('parasito.par_id',$par_id)
    ->get();

    return response()->json(['status'=>'ok', 'parasito_tratamiento'=> $parasito_tratamiento], 200);   
  }
  
  /*lista de tratamientos sin asignar*/
  public function sin_asignar($par_id){
    $tratamientos_asignados=Parasito_tratamiento::where('parasito_tratamiento.par_id',$par_id)->select('trat_id')->get();
    $parasito_tratamiento = Tratamiento::select('trat_id','trat_nombre','trat_dosis','trat_descripcion')
    ->whereNotIn('tratamiento.trat_id',$tratamientos_asignados)
    ->orderBy('updated_at')
    ->get();



    return response()->json(['status'=>'ok', 'tratamiento'=> $parasito_tratamiento], 200);    

  }

    public function destroy($pt_id)
    {
        $parasitoTratamiento = Parasito_tratamiento::find($pt_id);

        if (!$parasitoTratamiento)
        {    
            return response()->json(["mensaje"=>"no se encuentra un tratamiento con ese codigo"]);
         }

        $parasitoTratamiento->delete();
        return response()->json([
          'status'=>'ok',
            "mensaje" => "eliminado Parasito Tratamiento"
            ], 200
        );
    }

  

}
