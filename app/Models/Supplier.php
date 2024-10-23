<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function items() {
        return $this->hasMany(Item::class);
    }
    public function purchaseOrders() {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    protected $fillable = [
        'name',
        'address',
        'tax_no',
        'country',
        'mobile_no',
        'email',
        'status',
    ];
}
