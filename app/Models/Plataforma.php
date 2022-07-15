<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property Estado[] $estados
 * @property Pago[] $pagos
 */
class Plataforma extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'descripcion'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function estados()
    {
        return $this->hasMany('App\Estado', 'id_plataforma');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pagos()
    {
        return $this->hasMany('App\Pago', 'id_plataforma');
    }
}
