<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Http\Requests;
use App\Models\EstablecimientoSolicitante;
use App\Models\Zona;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Departamento;
use App\Models\Empresa;

class EstablecimientoSolicitanteController extends Controller
{
    //listar todos los establecimientos
    public function index()
    {
        $est_sol=EstablecimientoSolicitante::all();
        return response()->json(['status'=>'ok',"msg" => "exito", "est_sol" => $est_sol], 200);

    }
        # crea un establecimiento solicitante
    public function store(Request $request)
    {
        $est_sol = new EstablecimientoSolicitante();

        $est_sol->coo_per_id=$request->coo_per_id;
        $est_sol->zon_id=$request->zon_id;
        $est_sol->ess_razon_social=Str::upper($request->ess_razon_social);
        $est_sol->ess_telefono=$request->ess_telefono;
        $est_sol->ess_correo_electronico=$request->ess_correo_electronico;
        $est_sol->ess_tipo=Str::upper($request->ess_tipo);//--publico o privado
        $est_sol->ess_avenida_calle=Str::upper($request->ess_avenida_calle);
        $est_sol->ess_numero=$request->ess_numero;
        $est_sol->ess_stand=Str::upper($request->ess_stand);
        $est_sol->ess_latitud=$request->ess_latitud;//guarda vacio si no se envia nada
        $est_sol->ess_longitud=$request->ess_longitud;//guarda vacio si no se envia nada
        $est_sol->ess_altitud=$request->ess_altitud;//guarda vacio si no se envia nada
        $est_sol->save();
        return response()->json(["msg" => "exito", "est_sol" => $est_sol], 200);

    }
    //actualizar
    public function update(Request $request)
    {
        $est_sol=EstablecimientoSolicitante::find($request->ess_id);
        if(!$est_sol){
            return response()->json(["mensaje"=>"No se encuentra el establecimiento"]);
        }

        $est_sol->coo_per_id=$request->coo_per_id;
        $est_sol->zon_id=$request->zon_id;
        $est_sol->ess_razon_social=Str::upper($request->ess_razon_social);
        $est_sol->ess_telefono=$request->ess_telefono;
        $est_sol->ess_correo_electronico=$request->ess_correo_electronico;
        $est_sol->ess_tipo=Str::upper($request->ess_tipo);//--publico o privado
        $est_sol->ess_avenida_calle=Str::upper($request->ess_avenida_calle);
        $est_sol->ess_numero=$request->ess_numero;
        $est_sol->ess_stand=Str::upper($request->ess_stand);
        $est_sol->ess_latitud=$request->ess_latitud;//guarda vacio si no se envia nada
        $est_sol->ess_longitud=$request->ess_longitud;//guarda vacio si no se envia nada
        $est_sol->ess_altitud=$request->ess_altitud;//guarda vacio si no se envia nada
        $est_sol->save();
        return response()->json(["msg" => "exito", "est_sol" => $est_sol], 200);
    }

    public function show($ess_id)
    {
        # code...
        $est_sol=EstablecimientoSolicitante::find($ess_id);
        if(!$est_sol){
            return response()->json(["mensaje"=>"No se encuentra el establecimiento"]);
        }
        $empresa=Empresa::where('ess_id', $ess_id)->get();
        $zon_id=$est_sol->zon_id;
        $zona=Zona::find($zon_id);
        $municipio=Municipio::find($zona->mun_id);
        $provincia=Provincia::find($municipio->mun_id);
        $departamento=Departamento::find($provincia->dep_id);
        if (!$empresa) {
            $resultado=compact('est_sol', 'zona', 'municipio', 'provincia', 'departamento');
            return response()->json(['status'=>'ok',"msg" => "exito",'establecimiento'=>$resultado],200);
        }

        // $empresa=Empresa::

        $resultado=compact('est_sol', 'empresa', 'zona', 'municipio', 'provincia', 'departamento');
        return response()->json(['status'=>'ok',"msg" => "exito",'establecimiento'=>$resultado],200);

    }
}

// &coo_per_id=2&zon_id=3&ess_razon_social=LA PENSION&ess_telefono=2223317&ess_correo_electronico=lapension@gmail.com&ess_tipo=PRIVADO&ess_avenida_calle=AVENIDA&ess_numero=123456&ess_stand=5
