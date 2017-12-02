<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $mun_id
 * @property int $pro_id
 * @property int $reg_id
 * @property int $mun_cod_sice
 * @property int $pro_cod_sice
 * @property string $mun_nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Provincium $provincium
 * @property Region $region
 * @property Direccion[] $direccions
 * @property Zona[] $zonas
 */
class Municipio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'municipio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'mun_id';

    /**
     * @var array
     */
    protected $fillable = ['pro_id', 'reg_id', 'mun_cod_sice', 'pro_cod_sice', 'mun_nombre', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provincium()
    {
        return $this->belongsTo('App\Provincium', 'pro_id', 'pro_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region', 'reg_id', 'reg_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function direccions()
    {
        return $this->hasMany('App\Direccion', 'mun_id', 'mun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function zonas()
    {
        return $this->hasMany('App\Zona', 'mun_id', 'mun_id');
    }
}
