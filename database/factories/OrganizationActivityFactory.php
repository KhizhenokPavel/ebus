<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationActivity>
 */
class OrganizationActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $organization = Organization::query()->inRandomOrder()->first();
        $activity = Activity::query()->inRandomOrder()->first();

        if ($organization) {
            $result['organization_id'] = $organization->id;
        } else {
            $result['organization_id'] = Organization::factory();
        }

        if ($activity) {
            $result['activity_id'] = $activity->id;
        } else {
            $result['activity_id'] = Activity::factory();
        }

        return $result;
    }
}
