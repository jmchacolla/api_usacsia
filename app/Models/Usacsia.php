<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $usa_id
 * @property string $usa_nombre
 * @property string $usa_fecha_inicio_actividad
 * @property string $usa_zona_localidad_comuni
 * @property string $usa_avenida_calle
 * @property string $usa_numero
 * @property string $usa_inicio_atencion
 * @property string $usa_final_atencion
 * @property float $usa_latitud
 * @property float $usa_longitud
 * @property float $usa_altitud
 * @property string $usa_codigo
 * @property int $usa_fax
 * @property string $usa_correo_electronico
 * @property string $usa_direccion_web
 * @property string $usa_fecha_creacion
 * @property string $usa_municipio
 * @property string $usa_provincia
 * @property string $usa_departamento
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Ambiente[] $ambientes
 */
class Usacsia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'usacsia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'usa_id';

    /**
     * @var array
     */
    protected $fillable = ['usa_nombre', 'usa_fecha_inicio_actividad', 'usa_zona_localidad_comuni', 'usa_avenida_calle', 'usa_numero', 'usa_inicio_atencion', 'usa_final_atencion', 'usa_latitud', 'usa_longitud', 'usa_altitud', 'usa_codigo', 'usa_fax', 'usa_correo_electronico', 'usa_direccion_web', 'usa_fecha_creacion', 'usa_municipio', 'usa_provincia', 'usa_departamento'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    public function ambientes()
    {
        return $this->hasMany('App\Ambiente', 'usa_id', 'usa_id');
    }
}
 