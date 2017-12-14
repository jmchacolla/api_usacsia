<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $trat_id
 * @property string $trat_nombre
 * @property string $trat_dosis
 * @property string $trat_descripcion
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property EnfermedadTratamiento[] $enfermedadTratamientos
 * @property PruebaEnfeTrat[] $pruebaEnfeTrats
 * @property PruebaParTrat[] $pruebaParTrats
 * @property ParasitoTratamiento[] $parasitoTratamientos
 */
class Tratamiento extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tratamiento';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'trat_id';

    /**
     * @var array
     */
    protected $fillable = ['trat_nombre', 'trat_dosis', 'trat_descripcion'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enfermedadTratamiento()
    {
        return $this->hasMany('App\EnfermedadTratamiento', 'trat_id', 'trat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaEnfeTrat()
    {
        return $this->hasMany('App\PruebaEnfeTrat', 'trat_id', 'trat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaParTrat()
    {
        return $this->hasMany('App\PruebaParTrat', 'trat_id', 'trat_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parasitoTratamiento()
    {
        return $this->hasMany('App\ParasitoTratamiento', 'trat_id', 'trat_id');
    }
}
