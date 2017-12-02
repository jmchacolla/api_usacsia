<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $tra_id
 * @property string $tra_nombre
 * @property float $tra_costo
 * @property int $tra_vigencia
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 * @property PersonaTramite[] $personaTramites
 * @property EmpresaTramite[] $empresaTramites
 */
class Tramite extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'tramite';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'tra_id';

    /**
     * @var array
     */
    protected $fillable = ['tra_nombre', 'tra_costo', 'tra_vigencia'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at', 'userid_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function personaTramites()
    {
        return $this->hasMany('App\PersonaTramite', 'tra_id', 'tra_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function empresaTramites()
    {
        return $this->hasMany('App\EmpresaTramite', 'tra_id', 'tra_id');
    }
}
