<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'cors'], function () 
{  

    Route::get('/', function () {
        return view('welcome API_USACSIA');
    });
    Route::get('pais','PaisController@index');
    Route::post('pais','PaisController@store');
    Route::resource('usacsia','UsacsiaController', ['only'=>['index','update']]);
    Route::resource('telefono','TelefonoController', ['only'=>['index','update']]);
    Route::resource('enfermedad','EnfermedadController', ['only'=>['index','show','store','update','destroy']]);

    //Listar tratamientos de una enfermedad enf_id
    Route::get('tratamientos_x_enfermedad/{enfe_id}','EnfermedadController@tratamientos_x_enfermedad');
    //Listar tratamientos de un parasito par_id
    Route::get('tratamientos_x_parasito/{par_id}','Parasito_tratamientoController@tratamientos_x_parasito');

    Route::resource('tratamiento','TratamientoController', ['only'=>['index','show','store','update','destroy']]);
    Route::post('enfermedad_tratamiento','Enfermedad_tratamientoController@store');
    Route::post('parasito_tratamiento','Parasito_tratamientoController@store');
    Route::resource('parasito','ParasitoController',['only'=>['index','show','store','update']]);
    Route::resource('ficha','FichaController', ['only'=>['index','show','store','update','destroy']]);

    Route::resource('trat_de_parasitos_en_la_prueba','Prueba_par_tratController', ['only'=>['index','show','store','update','destroy']]);
    
    Route::resource('prueba_laboratorio','Prueba_laboratorioController', ['only'=>['index','show','store','update','destroy']]);
    Route::resource('prueba_par','Prueba_parController', ['only'=>['index','show','store','update','destroy']]);

    /*wen*/
    Route::get('ambiente','AmbienteController@index');
    Route::post('ambiente','AmbienteController@store');

    /*CONSULTORIO*/
    Route::resource('consultorio','ConsultorioController',['only' => ['store', 'update', 'destroy', 'show']]);
    Route::get('consultorio','ConsultorioController@index');
    Route::post('ambiente_consultorio','ConsultorioController@crear_ambiente_consultorio');
    Route::get('lis_consultorio','ConsultorioController@listar_consultorios');
/*LABORATORIO*/
    Route::resource('laboratorio','LaboratorioController',['only' => ['store', 'update', 'destroy', 'show']]);
    Route::get('laboratorio','LaboratorioController@index');
    Route::post('ambiente_laboratorio','LaboratorioController@crear_ambiente_laboratorio');
    Route::get('lis_laboratorio','LaboratorioController@listar_laboratorios');
/*TRAMITES*/
    Route::get('tramite','TramiteController@index');
    Route::resource('tramite','TramiteController',['only' => ['store', 'update', 'destroy', 'show']]);
/*PERSONA_TRAMITE*/
    Route::resource('pers_tra','Persona_TramiteController',['only' => ['store', 'update', 'destroy', 'show','index']]);
/*PRUEBA MEDICA*/
    Route::resource('prueba_medica','Prueba_MedicaController',['only' => ['store', 'update', 'destroy', 'show','index']]);
/*PRUEBA ENFERMEDAD*/
    Route::resource('prueba_enfermedad','Prueba_EnfermedadController',['only' => ['store', 'update', 'destroy', 'show','index']]);
    Route::get('consulta/{pm_id}','Prueba_MedicaController@listar_enfermedades_prueba');
    Route::post('consulta','Prueba_EnfermedadController@crear_prueba_medica_enfermedad');
/*CARIES*/
    Route::resource('caries','CariesController',['only' => ['store', 'update', 'destroy', 'show','index']]);
    /*--*/


    /*jhon*/
    //listar servicios
    Route::get('servicio','ServicioController@index');
    //listar departamentos
    Route::get('departamento','DepartamentoController@index');
    //listar provincias
    Route::get('provincia','ProvinciaController@index');
    //listar provincia por departamento
    Route::get('provincia/{dep_id}','ProvinciaController@pronvicia_departamento');
    //listar municipios
    Route::get('municipio','MunicipioController@index');
    //listar municipio por provincia 
    Route::get('municipio/{pro_id}','MunicipioController@municipio_provincia');
    //listar todas las personas
     Route::get('persona','PersonaController@index');
    //listar zona por municipio
    Route::get('zona/{mun_id}', 'ZonaController@index');
    //crear persona
    Route::resource('persona', 'PersonaController', ['only' => ['store', 'update', 'show']]);
    //listar funcionarios por cargo 
    Route::get('funcionario_cargo/{cargo}', 'FuncionarioController@listaporcargo');
    //crear persona y funcionario
    Route::post('funcionario_persona', 'FuncionarioController@crear_funcionario');
    // operaciones con funcionario, crear funcionario desde una persona existente 
    Route::resource('funcionario','FuncionarioController',['only' => ['index', 'store', 'update', 'show']]);
    //operaciones con firma para crear debe corresponder al cargo
    Route::resource('funcionario/firma','FirmaController',['only' => ['index', 'store', 'update', 'show']]);

    // Route::get('fecha', 'HorarioController@index');
    // index input(fun_id)
    // store input(ser_id, amb_id, fun_id, hor_fecha_inicio, hor_fecha_final)
    Route::resource('horario', 'HorarioController', ['only' =>['index', 'store', 'update', 'show']]);
    
});

