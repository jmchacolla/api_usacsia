<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $par_id
 * @property string $par_nombre
 * @property string $par_descripcion
 * @property string $par_clasificacion
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PruebaPar[] $pruebaPars
 * @property ParasitoTratamiento[] $parasitoTratamientos
 */
class Parasito extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'parasito';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'par_id';

    /**
     * @var array
     */
    protected $fillable = ['par_nombre', 'par_descripcion', 'par_clasificacion'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaPars()
    {
        return $this->hasMany('App\PruebaPar', 'par_id', 'par_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parasitoTratamientos()
    {
        return $this->hasMany('App\ParasitoTratamiento', 'par_id', 'par_id');
    }
}
