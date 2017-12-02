<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ser_id
 * @property string $ser_nombre
 * @property string $ser_tipo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Horario[] $horarios
 * @property PruebaMedica[] $pruebaMedicas
 */
class Servicio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'servicio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ser_id';

    /**
     * @var array
     */
    protected $fillable = ['ser_nombre', 'ser_tipo'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horarios()
    {
        return $this->hasMany('App\Horario', 'ser_id', 'ser_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaMedicas()
    {
        return $this->hasMany('App\PruebaMedica', 'ser_id', 'ser_id');
    }
}
