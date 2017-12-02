<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $enfe_id
 * @property string $enfe_nombre
 * @property string $enfe_causas
 * @property string $enfe_descripcion
 * @property string $enfe_prevencion
 * @property boolean $enfe_necesita_ref
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property EnfermedadTratamiento[] $enfermedadTratamientos
 * @property PruebaEnfermedad[] $pruebaEnfermedads
 * @property PruebaEnfermedad[] $pruebaEnfermedads
 * @property Cary[] $caries
 */
class Enfermedad extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'enfermedad';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'enfe_id';

    /**
     * @var array
     */
    protected $fillable = ['enfe_nombre', 'enfe_causas', 'enfe_descripcion', 'enfe_prevencion', 'enfe_necesita_ref'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enfermedadTratamientos()
    {
        return $this->hasMany('App\EnfermedadTratamiento', 'enfe_id', 'enfe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaEnfermedads()
    {
        return $this->hasMany('App\PruebaEnfermedad', 'enfe_id', 'enfe_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function caries()
    {
        return $this->hasMany('App\Cary', 'enfe_id', 'enfe_id');
    }
}
