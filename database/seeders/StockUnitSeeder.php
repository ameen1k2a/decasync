<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockUnit;

class StockUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
        {
            $units = [
                ['name' => 'Kilogram'],
                ['name' => 'Liter'],
                ['name' => 'Piece'],
                ['name' => 'Box'],
                ['name' => 'Packet']
            ];

            foreach ($units as $unit) {
                StockUnit::create($unit); // Use the model to insert the data
            }
        }
}
