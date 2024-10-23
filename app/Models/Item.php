<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }


    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function stockUnit()
    {
        return $this->belongsTo(StockUnit::class, 'stock_unit', 'id'); // Assuming 'stock_unit' is the foreign key
    }


    protected $fillable = [
        'name',
        'inventory_location',
        'brand',
        'category',
        'supplier_id',
        'stock_unit',
        'unit_price',
        'images',
        'status',
    ];
}
