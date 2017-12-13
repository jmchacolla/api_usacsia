<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pp_id
 * @property int $pl_id
 * @property int $par_id
 * @property boolean $pp_resultado
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PruebaLaboratorio $pruebaLaboratorio
 * @property Parasito $parasito
 * @property PruebaParTrat[] $pruebaParTrats
 */
class Prueba_par extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prueba_par';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pp_id';

    /**
     * @var array
     */
    protected $fillable = ['pl_id', 'par_id', 'pp_resultado'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pruebaLaboratorio()
    {
        return $this->belongsTo('App\PruebaLaboratorio', 'pl_id', 'pl_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parasito()
    {
        return $this->belongsTo('App\Parasito', 'par_id', 'par_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaParTrats()
    {
        return $this->hasMany('App\PruebaParTrat', 'pp_id', 'pp_id');
    }
}
