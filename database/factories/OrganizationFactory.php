<?php

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $result['name'] = $this->faker->company;
        $building = Building::query()->inRandomOrder()->first();

        if ($building) {
            $result['building_id'] = $building->id;

            return $result;
        }

        $result['building_id'] = Building::factory();

        return $result;
    }
}
