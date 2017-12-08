<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pm_id
 * @property int $pt_id
 * @property int $ser_id
 * @property int $fun_id
 * @property string $pm_fr
 * @property string $pm_fc
 * @property string $pm_peso
 * @property float $pm_talla
 * @property int $pm_imc
 * @property string $pm_diagnostico
 * @property string $pm_estado
 * @property string $pm_fecha
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PersonaTramite $personaTramite
 * @property Servicio $servicio
 * @property Funcionario $funcionario
 * @property PruebaEnfermedad[] $pruebaEnfermedads
 * @property PruebaEnfermedad[] $pruebaEnfermedads
 */
class Prueba_medica extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'prueba_medica';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pm_id';

    /**
     * @var array
     */
    protected $fillable = ['pt_id', 'ser_id', 'fun_id', 'pm_fr', 'pm_fc', 'pm_peso', 'pm_talla', 'pm_imc', 'pm_diagnostico', 'pm_estado', 'pm_fecha'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function personaTramite()
    {
        return $this->belongsTo('App\PersonaTramite', 'pt_id', 'pt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function servicio()
    {
        return $this->belongsTo('App\Servicio', 'ser_id', 'ser_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function funcionario()
    {
        return $this->belongsTo('App\Funcionario', 'fun_id', 'fun_id');
    }
    public function ficha()
    {
        return $this->belongsTo('App\Ficha', 'fic_id', 'fic_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaEnfermedads()
    {
        return $this->hasMany('App\PruebaEnfermedad', 'pm_id', 'pm_id');
    }
}
