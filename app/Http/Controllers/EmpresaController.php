<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Empresa;
use App\Models\EstablecimientoSolicitante;
use App\Models\Rubro_empresa;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresa=\App\Models\Empresa::all();

        return response()->json(['status'=>'ok','mensaje'=>'exito','empresa'=>$empresa],200); 

    public function store(Request $request)
    {
        $empresa = new Empresa();
        $empresa->ess_id=$request->ess_id;
        $empresa->emp_kardex=$request->emp_kardex;
        $empresa->emp_nit=$request->emp_nit;
        $empresa->emp_url_nit=$request->emp_url_nit;
        $empresa->emp_url_licencia=$request->emp_url_licencia;

        $empresa->save();
        $rubro=new Rubro_empresa();
        $rubro->emp_id= $empresa->emp_id;
        $rubro->ru_nombre= $request->ru_nombre;
        $rubro->save();
        $resultado =compact('empresa', 'rubro');

        return response()->json(["msg" => "exito", "empresa" => $resultado], 200);

    }
}
