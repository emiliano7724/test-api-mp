<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $nombre
 * @property integer $cuit
 * @property string $token_mp
 * @property string $key_mp
 */
class Cliente extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['nombre', 'cuit', 'token_mp', 'key_mp'];
}
