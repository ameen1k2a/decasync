<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockUnit extends Model
{
    //use HasFactory;

    // Specify the table name if it differs from the plural form of the model name
    protected $table = 'stock_units';

    // Specify which fields can be mass assigned
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(Item::class, 'stock_unit', 'id'); // 'stock_unit' is the foreign key in the items table
    }
}
