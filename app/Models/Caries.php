<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $car_id
 * @property int $enfe_id
 * @property int $pre_id
 * @property int $car_nro_pieza
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Enfermedad $enfermedad
 */
class Caries extends Model
{
    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'car_id';

    /**
     * @var array
     */
    protected $fillable = ['enfe_id', 'pre_id', 'car_nro_pieza'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enfermedad()
    {
        return $this->belongsTo('App\Enfermedad', 'enfe_id', 'enfe_id');
    }
}
