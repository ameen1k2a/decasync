<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    // In ItemImage.php model
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    protected $fillable = [
        'item_id', 
        'path' 
    ];

}
