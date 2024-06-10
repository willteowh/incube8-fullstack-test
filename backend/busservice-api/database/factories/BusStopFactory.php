<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusStop>
 */
class BusStopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bus_stop_name' => $this->faker->streetName,
            'bus_stop_location_latitude' => $this->faker->randomFloat(4, 1.3200, 1.3800),
            'bus_stop_location_longitude' => $this->faker->randomFloat(4, 102.5000, 103.8000),
        ];
    }
}
