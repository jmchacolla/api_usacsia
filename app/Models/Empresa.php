<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property EstablecimientoSolicitante $establecimientoSolicitante
 * @property Categorium $categorium
 * @property EmpresaPropietario[] $empresaPropietarios
 * @property PagoArancel[] $pagoArancels
 * @property int $emp_id
 * @property int $ess_id
 * @property int $cat_id
 * @property int $emp_kardex
 * @property string $emp_rubro
 * @property string $emp_nit
 * @property string $emp_url_nit
 * @property string $emp_url_licencia
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Empresa extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'empresa';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'emp_id';

    /**
     * @var array
     */
    protected $fillable = ['ess_id', 'cat_id', 'emp_kardex', 'emp_nit', 'emp_url_nit', 'emp_url_licencia'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function establecimientoSolicitante()
    {
        return $this->belongsTo('App\EstablecimientoSolicitante', 'ess_id', 'ess_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresaPropietarios()
    {
        return $this->hasMany('App\EmpresaPropietario', 'emp_id', 'emp_id');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
        public function rubro()
    {
        return $this->hasMany('App\Rubro', 'emp_id', 'emp_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagoArancels()
    {
        return $this->hasMany('App\PagoArancel', 'emp_id', 'emp_id');
    }
}
