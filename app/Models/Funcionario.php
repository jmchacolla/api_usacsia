<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Persona $persona
 * @property Firma[] $firmas
 * @property Horario[] $horarios
 * @property PruebaMedica[] $pruebaMedicas
 * @property PruebaLaboratorio[] $pruebaLaboratorios
 * @property Categorium[] $categorias
 * @property FichaInspeccion[] $fichaInspeccions
 * @property Sancion[] $sancions
 * @property PagoArancel[] $pagoArancels
 * @property Laboratorio[] $laboratorios
 * @property Subgrupo[] $subgrupos
 * @property Subgrupo[] $subgrupos
 * @property Subgrupo[] $subgrupos
 * @property int $fun_id
 * @property int $per_id
 * @property string $fun_profesion
 * @property string $fun_cargo
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Funcionario extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'funcionario';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'fun_id';

    /**
     * @var array
     */
    protected $fillable = ['per_id', 'fun_profesion', 'fun_cargo','fun_estado'];
    protected $hidden = ['created_at','updated_at','userid_at','deleted_at'];
    protected $dates=['deleted_at'];

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
    public function firmas()
    {
        return $this->hasMany('App\Firma', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function horarios()
    {
        return $this->hasMany('App\Horario', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaMedicas()
    {
        return $this->hasMany('App\PruebaMedica', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pruebaLaboratorios()
    {
        return $this->hasMany('App\PruebaLaboratorio', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categorias()
    {
        return $this->hasMany('App\Categorium', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fichaInspeccions()
    {
        return $this->hasMany('App\FichaInspeccion', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sancions()
    {
        return $this->hasMany('App\Sancion', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagoArancels()
    {
        return $this->hasMany('App\PagoArancel', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function laboratorios()
    {
        return $this->hasMany('App\Laboratorio', 'fun_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subgrupoMedico()
    {
        return $this->hasMany('App\Subgrupo', 'fun_med_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subgrupoEnfermera()
    {
        return $this->hasMany('App\Subgrupo', 'fun_enf_id', 'fun_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subgrupoLaboratorio()
    {
        return $this->hasMany('App\Subgrupo', 'fun_labo_id', 'fun_id');
    }
}
