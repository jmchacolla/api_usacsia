<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property PersonaTramite $personaTramite
 * @property int $mue_id
 * @property int $pt_id
 * @property int $mue_num_muestra
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Muestra extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'muestra';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'mue_id';

    /**
     * @var array
     */
    protected $fillable = ['pt_id', 'mue_num_muestra', 'created_at', 'updated_at', 'deleted_at', 'userid_at','mue_fecha'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTramite()
    {
        return $this->belongsTo('App\PersonaTramite', 'pt_id', 'pt_id');
    }
}
