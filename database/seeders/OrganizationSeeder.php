<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Organization;
use App\Models\OrganizationActivity;
use App\Models\OrganizationPhone;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::factory()->count(10)->create()->each(function ($organization) {
            OrganizationPhone::factory()
                ->count(rand(0, 5))
                ->create(['organization_id' => $organization->id]);

            $iterations = range(0, rand(1, 3));

            foreach($iterations as $ignored) {
                $activity = Activity::query()->inRandomOrder()->first();

                $activityId = $activity ? $activity->id : Activity::factory();

                OrganizationActivity::factory()->create(
                    [
                        'organization_id' => $organization->id,
                        'activity_id' => $activityId,
                    ]
                );
            }
        });
    }
}
