<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Horario $horario
 * @property int $ct_id
 * @property int $hor_id
 * @property string $ct_dia
 * @property string $ct_turno
 * @property string $ct_ini_turno
 * @property string $ct_fin_turno
 * @property int $ct_ficha_total
 * @property int $ct_promedio
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class ConfiguracionTurno extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'configuracion_turno';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ct_id';

    /**
     * @var array
     */
    protected $fillable = ['hor_id', 'ct_dia', 'ct_turno', 'ct_ini_turno', 'ct_fin_turno', 'ct_ficha_total', 'ct_promedio'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates =['deleted_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function horario()
    {
        return $this->belongsTo('App\Horario', 'hor_id', 'hor_id');
    }
}
