<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $fir_id
 * @property int $fun_id
 * @property string $fir_fecha_inicio
 * @property string $fir_fecha_fin
 * @property string $fir_url
 * @property Funcionario $funcionario
 */
class Firma extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'firma';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'fir_id';

    /**
     * @var array
     */
    protected $fillable = ['fun_id', 'fir_fecha_inicio', 'fir_fecha_fin', 'fir_url'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario', 'fun_id', 'fun_id');
    }
}
