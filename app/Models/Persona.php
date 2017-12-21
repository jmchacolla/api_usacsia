<?php

namespace App\Models;
use Carbon;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $per_id
 * @property int $zon_id
 * @property string $per_ci
 * @property string $per_tipo_documento
 * @property string $per_pais
 * @property string $per_ci_expedido
 * @property string $per_nombres
 * @property string $per_apellido_primero
 * @property string $per_apellido_segundo
 * @property string $per_fecha_nacimiento
 * @property string $per_genero
 * @property string $per_email
 * @property string $per_numero_celular
 * @property string $per_clave_publica
 * @property string $per_avenida_calle
 * @property string $per_numero
 * @property string $per_ocupacion
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Zona $zona
 * @property Listum[] $listas
 * @property Imagen[] $imagens
 * @property Direccion[] $direccions
 * @property PersonaTramite[] $personaTramites
 * @property PNatural[] $pNaturals
 * @property EstablecimientoSolicitante[] $establecimientoSolicitantes
 * @property EstablecimientoPersona[] $establecimientoPersonas
 * @property Funcionario[] $funcionarios
 */
class Persona extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'persona';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'per_id';

    /**
     * @var array
     */
    protected $fillable = ['zon_id', 'per_ci', 'per_tipo_documento', 'per_pais', 'per_ci_expedido', 'per_nombres', 'per_apellido_primero', 'per_apellido_segundo', 'per_fecha_nacimiento', 'per_genero', 'per_email', 'per_numero_celular', 'per_clave_publica', 'per_avenida_calle', 'per_numero', 'per_ocupacion'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function zona()
    {
        return $this->belongsTo('App\Zona', 'zon_id', 'zon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listas()
    {
        return $this->hasMany('App\Listum', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagens()
    {
        return $this->hasMany('App\Imagen', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function direccions()
    {
        return $this->hasMany('App\Direccion', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personaTramites()
    {
        return $this->hasMany('App\PersonaTramite', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pNaturals()
    {
        return $this->hasMany('App\PNatural', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function establecimientoSolicitantes()
    {
        return $this->hasMany('App\EstablecimientoSolicitante', 'coo_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function establecimientoPersonas()
    {
        return $this->hasMany('App\EstablecimientoPersona', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function funcionarios()
    {
        return $this->hasMany('App\Funcionario', 'per_id', 'per_id');
    }


    public function scopeEdad($per_fecha_nacimiento)
    {

        $fecha_nacimiento = new Carbon($per_fecha_nacimiento);

        $año_n = $fecha_nacimiento->format('Y');
        $mes_n = $fecha_nacimiento->format('m');
        $dia_n = $fecha_nacimiento->format('d');  
        $edad = Carbon::createFromDate($año_n,$mes_n,$dia_n)->age;

        if($edad=="")    
        {
            return -1;
        } 
        return $edad;
        }
    }


