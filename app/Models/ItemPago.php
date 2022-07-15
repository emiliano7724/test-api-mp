<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $id_pago
 * @property string $title
 * @property int $quantity
 * @property float $unit_price
 * @property string $description
 * @property int $category_id
 * @property string $picture_url
 * @property int $currency_id
 * @property Pago $pago
 */
class ItemPago extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'items_pago';

    /**
     * @var array
     */
    protected $fillable = ['id_pago', 'title', 'quantity', 'unit_price', 'description', 'category_id', 'picture_url', 'currency_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function pago()
    {
        return $this->belongsTo('App\Pago', 'id_pago');
    }
}
