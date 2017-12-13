<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Empresa $empresa
 * @property int $re_id
 * @property int $emp_id
 * @property string $re_nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Rubro_empresa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rubro_empresa';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 're_id';

    /**
     * @var array
     */
    protected $fillable = ['emp_id', 're_nombre'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo('App\Empresa', 'emp_id', 'emp_id');
    }
}
