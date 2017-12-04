<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Servicio $servicio
 * @property Ambiente $ambiente
 * @property Funcionario $funcionario
 * @property ConfiguracionTurno[] $configuracionTurnos
 * @property int $hor_id
 * @property int $ser_id
 * @property int $amb_id
 * @property int $fun_id
 * @property string $hor_fecha_in
 * @property string $hor_fecha_fin
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Horario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'horario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'hor_id';

    /**
     * @var array
     */
    protected $fillable = ['ser_id', 'amb_id', 'fun_id', 'hor_fecha_in', 'hor_fecha_fin', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicio()
    {
        return $this->belongsTo('App\Servicio', 'ser_id', 'ser_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ambiente()
    {
        return $this->belongsTo('App\Ambiente', 'amb_id', 'amb_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configuracionTurnos()
    {
        return $this->hasMany('App\ConfiguracionTurno', 'hor_id', 'hor_id');
    }
}
