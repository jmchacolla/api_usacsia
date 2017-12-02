<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $pt_id
 * @property int $tra_id
 * @property int $per_id
 * @property int $pt_numero_tramite
 * @property string $pt_vigencia_pago
 * @property string $pt_fecha_ini
 * @property string $pt_fecha_fin
 * @property string $pt_estado_pago
 * @property string $pt_estado_tramite
 * @property float $pt_monto
 * @property string $pt_tipo_tramite
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property Tramite $tramite
 * @property Persona $persona
 * @property CarnetSanitario[] $carnetSanitarios
 * @property EmpresaTramitePersona[] $empresaTramitePersonas
 * @property Ficha[] $fichas
 * @property PruebaMedica[] $pruebaMedicas
 * @property PruebaLaboratorio[] $pruebaLaboratorios
 */
class Persona_tramite extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'persona_tramite';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'pt_id';

    /**
     * @var array
     */
    protected $fillable = ['tra_id', 'per_id', 'pt_numero_tramite', 'pt_vigencia_pago', 'pt_fecha_ini', 'pt_fecha_fin', 'pt_estado_pago', 'pt_estado_tramite', 'pt_monto', 'pt_tipo_tramite', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tramite()
    {
        return $this->belongsTo('App\Tramite', 'tra_id', 'tra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function persona()
    {
        return $this->belongsTo('App\Persona', 'per_id', 'per_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function carnetSanitarios()
    {
        return $this->hasMany('App\CarnetSanitario', 'pt_id', 'pt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresaTramitePersonas()
    {
        return $this->hasMany('App\EmpresaTramitePersona', 'pt_id', 'pt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichas()
    {
        return $this->hasMany('App\Ficha', 'pt_id', 'pt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaMedicas()
    {
        return $this->hasMany('App\PruebaMedica', 'pt_id', 'pt_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaLaboratorios()
    {
        return $this->hasMany('App\PruebaLaboratorio', 'pt_id', 'pt_id');
    }
}
