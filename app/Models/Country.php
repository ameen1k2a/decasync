<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /** @use HasFactory<\Database\Factories\CountryFactory> */
    use HasFactory;

    public function suppliers()
    {
        return $this->hasMany(Supplier::class);
    }
    protected $fillable = [
        'country_name',
        'country_code',
    ];
}
