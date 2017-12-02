<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $ima_id
 * @property int $per_id
 * @property string $ima_nombre
 * @property string $ima_enlace
 * @property string $ima_tipo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Persona $persona
 */
class Imagen extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'imagen';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'ima_id';

    /**
     * @var array
     */
    protected $fillable = ['per_id', 'ima_nombre', 'ima_enlace', 'ima_tipo', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'per_id', 'per_id');
    }
}
