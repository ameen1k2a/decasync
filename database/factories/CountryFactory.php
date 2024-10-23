<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Country;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Country::class;

    public function definition()
    {
        return [
            'country_name' => $this->faker->country(),
            'country_code' => $this->faker->countryCode(), // You can use specific codes if needed
        ];
    }
}
