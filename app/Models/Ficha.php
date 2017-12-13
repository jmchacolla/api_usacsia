<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $fic_id
 * @property int $pt_id
 * @property int $fic_numero
 * @property string $fic_estado
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PersonaTramite $personaTramite
 */
class Ficha extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'ficha';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'fic_id';

    /**
     * @var array
     */
    protected $fillable = ['pt_id', 'fic_numero', 'fic_estado'];
    protected $hidden = ['created_at', 'updated_at', 'userid_at'];
    protected $dates=['deleted_at'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTramite()
    {
        return $this->belongsTo('App\PersonaTramite', 'pt_id', 'pt_id');
    }
}
