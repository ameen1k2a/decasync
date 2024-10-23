<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderItem extends Model
{
    //use HasFactory;

    protected $fillable = [
        'purchase_order_id',
        'item_id',
        'stock_unit',
        'unit_price',
        'packing_unit',
        'order_qty',
        'item_amount',
        'discount',
        'net_amount',
    ];

    public function purchaseOrder()
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
