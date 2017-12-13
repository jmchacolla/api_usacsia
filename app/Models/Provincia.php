<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pro_id
 * @property int $dep_id
 * @property int $pro_cod_sice
 * @property string $pro_nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Departamento $departamento
 * @property Municipio[] $municipios
 */
class Provincia extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'provincia';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pro_id';

    /**
     * @var array
     */
    protected $fillable = ['dep_id', 'pro_cod_sice', 'pro_nombre'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function departamento()
    {
        return $this->belongsTo('App\Departamento', 'dep_id', 'dep_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipios()
    {
        return $this->hasMany('App\Municipio', 'pro_id', 'pro_id');
    }
}
