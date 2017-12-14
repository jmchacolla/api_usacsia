<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pl_id
 * @property int $pt_id
 * @property int $fun_id
 * @property string $pl_estado
 * @property string $pl_tipo
 * @property string $pl_color
 * @property string $pl_aspecto
 * @property string $pl_fecha_recepcion
 * @property string $pl_observaciones
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PersonaTramite $personaTramite
 * @property Funcionario $funcionario
 * @property PruebaPar[] $pruebaPars
 */
class Prueba_laboratorio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prueba_laboratorio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pl_id';

    /**
     * @var array
     */

    protected $fillable = ['mue_id', 'fun_id', 'pl_estado', 'pl_tipo', 'pl_color', 'pl_aspecto','pl_moco','pl_sangre','pl_fecha_recepcion', 'pl_observaciones'];
    
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTramite()
    {
        return $this->belongsTo('App\PersonaTramite', 'pt_id', 'pt_id');
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
    public function pruebaPars()
    {
        return $this->hasMany('App\PruebaPar', 'pl_id', 'pl_id');
    }
}
