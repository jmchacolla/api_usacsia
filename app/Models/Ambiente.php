<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $amb_id
 * @property int $usa_id
 * @property string $amb_nombre
 * @property string $amb_tipo
 * @property string $amb_descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Usacsium $usacsium
 * @property Horario[] $horarios
 * @property Consultorio[] $consultorios
 * @property Laboratorio[] $laboratorios
 */
class Ambiente extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ambiente';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'amb_id';

    /**
     * @var array
     */
    protected $fillable = ['usa_id', 'amb_nombre', 'amb_tipo', 'amb_descripcion'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usacsium()
    {
        return $this->belongsTo('App\Usacsium', 'usa_id', 'usa_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horarios()
    {
        return $this->hasMany('App\Horario', 'amb_id', 'amb_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function consultorios()
    {
        return $this->hasMany('App\Consultorio', 'amb_id', 'amb_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laboratorios()
    {
        return $this->hasMany('App\Laboratorio', 'amb_id', 'amb_id');
    }
}
