<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ppt_id
 * @property int $pp_id
 * @property int $trat_id
 * @property string $ppt_fecha_emision
 * @property string $ppt_url_constancia
 * @property string $ppt_fecha_constancia
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PruebaPar $pruebaPar
 * @property Tratamiento $tratamiento
 */
class Prueba_par_trat extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prueba_par_trat';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ppt_id';

    /**
     * @var array
     */
    protected $fillable = ['pp_id', 'trat_id', 'ppt_fecha_emision', 'ppt_url_constancia', 'ppt_fecha_constancia'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pruebaPar()
    {
        return $this->belongsTo('App\PruebaPar', 'pp_id', 'pp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tratamiento()
    {
        return $this->belongsTo('App\Tratamiento', 'trat_id', 'trat_id');
    }
}
