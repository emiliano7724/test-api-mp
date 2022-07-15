<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_plataforma
 * @property string $codigo
 * @property string $descripcion
 * @property Plataforma $plataforma
 * @property Pago[] $pagos
 */
class Estado extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_plataforma', 'codigo', 'descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plataforma()
    {
        return $this->belongsTo('App\Plataforma', 'id_plataforma');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany('App\Pago', 'id_estado');
    }
}
