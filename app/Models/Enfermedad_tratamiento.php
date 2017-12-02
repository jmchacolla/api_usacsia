<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $et_id
 * @property int $enfe_id
 * @property int $trat_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Enfermedad $enfermedad
 * @property Tratamiento $tratamiento
 */
class Enfermedad_tratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'enfermedad_tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'et_id';

    /**
     * @var array
     */
    protected $fillable = ['enfe_id', 'trat_id', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enfermedad()
    {
        return $this->belongsTo('App\Enfermedad', 'enfe_id', 'enfe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tratamiento()
    {
        return $this->belongsTo('App\Tratamiento', 'trat_id', 'trat_id');
    }
}
