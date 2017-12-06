<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Zona $zona
 * @property Persona $persona
 * @property EstablecimientoPersona[] $establecimientoPersonas
 * @property EmpresaTramite[] $empresaTramites
 * @property Empresa[] $empresas
 * @property Listum[] $listas
 * @property int $ess_id
 * @property int $zon_id
 * @property int $coo_per_id
 * @property string $ess_razon_social
 * @property int $ess_telefono
 * @property string $ess_correo_electronico
 * @property string $ess_tipo
 * @property string $ess_avenida_calle
 * @property string $ess_numero
 * @property string $ess_stand
 * @property float $ess_latitud
 * @property float $ess_longitud
 * @property float $ess_altitud
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class EstablecimientoSolicitante extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'establecimiento_solicitante';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ess_id';

    /**
     * @var array
     */
    protected $fillable = ['zon_id', 'coo_per_id', 'ess_razon_social', 'ess_telefono', 'ess_correo_electronico', 'ess_tipo', 'ess_avenida_calle', 'ess_numero', 'ess_stand', 'ess_latitud', 'ess_longitud', 'ess_altitud'];
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'coo_per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function establecimientoPersonas()
    {
        return $this->hasMany('App\EstablecimientoPersona', 'ess_id', 'ess_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresaTramites()
    {
        return $this->hasMany('App\EmpresaTramite', 'ess_id', 'ess_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresas()
    {
        return $this->hasMany('App\Empresa', 'ess_id', 'ess_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listas()
    {
        return $this->hasMany('App\Listum', 'ess_id', 'ess_id');
    }
}
