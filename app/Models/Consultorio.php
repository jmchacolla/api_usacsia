<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $con_id
 * @property int $amb_id
 * @property string $con_cod
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Ambiente $ambiente
 */
class Consultorio extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'consultorio';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'con_id';

    /**
     * @var array
     */
    protected $fillable = ['amb_id', 'con_cod'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function ambiente()
    {
        return $this->belongsTo('App\Ambiente', 'amb_id', 'amb_id');
    }
}
