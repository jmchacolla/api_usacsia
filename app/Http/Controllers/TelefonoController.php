<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TelefonoController extends Controller
{
    //

    public function index($usa_id){
    	$telefonos = \App\Models\Telefono::where('usa_id',$usa_id)->get();

    	return response()->json(['status'=>'ok', 'telefono'=> $telefonos], 200);
    }

     public function update($nuevot,$tel_id){
    	$telefono = \App\Models\Telefono::find($tel_id);

    	$telefono->tel_numero = $nuevot->tel_numero;
    	$telefono->save();

    	return response()->json([
        		"msg" => "succes"
        	], 200
        );
    }

}
