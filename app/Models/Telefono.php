<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tel_id
 * @property int $usa_id
 * @property int $tel_numero
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Telefono extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'telefono';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'tel_id';

    /**
     * @var array
     */
    protected $fillable = ['usa_id', 'tel_numero'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];


}
