<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $dep_id
 * @property string $dep_nombre
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Provincium[] $provincias
 * @property Region[] $regions
 */
class Departamento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'departamento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'dep_id';

    /**
     * @var array
     */
    protected $fillable = ['dep_nombre', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provincias()
    {
        return $this->hasMany('App\Provincium', 'dep_id', 'dep_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function regions()
    {
        return $this->hasMany('App\Region', 'dep_id', 'dep_id');
    }
}
