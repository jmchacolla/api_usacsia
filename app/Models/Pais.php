<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $nac_id
 * @property string $nac_nombre
 * @property string $nac_capital
 * @property string $nac_continente
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property int $userid_at
 */
class Pais extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = '_pais';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'nac_id';

    /**
     * @var array
     */
    protected $fillable = ['nac_nombre', 'nac_capital', 'nac_continente', 'created_at', 'updated_at', 'deleted_at', 'userid_at'];

}
