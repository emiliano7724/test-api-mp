<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_plataforma
 * @property int $id_estado
 * @property string $fecha
 * @property string $preference_id
 * @property int $payment_id
 * @property string $collection_id
 * @property string $collection_status
 * @property string $status
 * @property string $external_reference
 * @property string $payment_type
 * @property string $merchant_order_id
 * @property string $site_id
 * @property string $processing_mode
 * @property string $merchant_account_id
 * @property Plataforma $plataforma
 * @property Estado $estado
 * @property ItemsPago[] $itemsPagos
 */
class Pago extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id_plataforma', 'id_estado', 'fecha', 'preference_id', 'payment_id', 'collection_id', 'collection_status', 'status', 'external_reference', 'payment_type', 'merchant_order_id', 'site_id', 'processing_mode', 'merchant_account_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plataforma()
    {
        return $this->belongsTo('App\Plataforma', 'id_plataforma');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo('App\Estado', 'id_estado');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function itemsPagos()
    {
        return $this->hasMany('App\ItemsPago', 'id_pago');
    }
}
