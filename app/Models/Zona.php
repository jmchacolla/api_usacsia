<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $zon_id
 * @property int $mun_id
 * @property string $zon_macrodistrito
 * @property string $zon_distrito
 * @property string $zon_nombre
 * @property Municipio $municipio
 * @property NuevaPersona[] $nuevaPersonas
 * @property EstablecimientoSolicitante[] $establecimientoSolicitantes
 * @property Persona[] $personas
 */
class Zona extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = '_zona';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'zon_id';

    /**
     * @var array
     */
    protected $fillable = ['mun_id', 'zon_macrodistrito', 'zon_distrito', 'zon_nombre'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function municipio()
    {
        return $this->belongsTo('App\Municipio', 'mun_id', 'mun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nuevaPersonas()
    {
        return $this->hasMany('App\NuevaPersona', 'zon_id', 'zon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function establecimientoSolicitantes()
    {
        return $this->hasMany('App\EstablecimientoSolicitante', 'zon_id', 'zon_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personas()
    {
        return $this->hasMany('App\Persona', 'zon_id', 'zon_id');
    }
}
