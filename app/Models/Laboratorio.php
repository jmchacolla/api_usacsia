<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $lab_id
 * @property int $amb_id
 * @property int $fun_id
 * @property string $lab_cod
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Ambiente $ambiente
 * @property Funcionario $funcionario
 */
class Laboratorio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'laboratorio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'lab_id';

    /**
     * @var array
     */
    protected $fillable = ['amb_id', 'fun_id', 'lab_cod'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

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
}
