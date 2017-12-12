<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pre_id
 * @property int $pm_id
 * @property int $enfe_id
 * @property boolean $pre_resultado
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PruebaMedica $pruebaMedica
 * @property Enfermedad $enfermedad
 * @property PruebaMedica $pruebaMedica
 * @property Enfermedad $enfermedad
 * @property PruebaEnfeTrat[] $pruebaEnfeTrats
 */
class Prueba_enfermedad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prueba_enfermedad';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pre_id';

    /**
     * @var array
     */
    protected $fillable = ['pm_id', 'enfe_id', 'pre_resultado'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Prueba_medica()
    {
        return $this->belongsTo('App\Prueba_medica', 'pm_id', 'pm_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enfermedad()
    {
        return $this->belongsTo('App\Enfermedad', 'enfe_id', 'enfe_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaEnfeTrats()
    {
        return $this->hasMany('App\PruebaEnfeTrat', 'pre_id', 'pre_id');
    }
}
