<?php

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationPhone>
 */
class OrganizationPhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $result['phone_number'] = $this->faker->phoneNumber;
        $organization = Organization::query()->inRandomOrder()->first();

        if ($organization) {
            $result['organization_id'] = $organization->id;

            return $result;
        }

        $result['organization_id'] = Organization::factory();

        return $result;
    }
}
