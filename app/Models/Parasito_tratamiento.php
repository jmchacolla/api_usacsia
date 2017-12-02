<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pt_id
 * @property int $par_id
 * @property int $trat_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Parasito $parasito
 * @property Tratamiento $tratamiento
 */
class Parasito_tratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'parasito_tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pt_id';

    /**
     * @var array
     */
    protected $fillable = ['par_id', 'trat_id'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parasito()
    {
        return $this->belongsTo('App\Parasito', 'par_id', 'par_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tratamiento()
    {
        return $this->belongsTo('App\Tratamiento', 'trat_id', 'trat_id');
    }
}
