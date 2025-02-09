<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food = Activity::factory()->create(['name' => 'Еда']);
        $food->children()->createMany([
            ['name' => 'Мясная продукция'],
            ['name' => 'Молочная продукция'],
        ]);

        $cars = Activity::factory()->create(['name' => 'Автомобили']);
        $cars->children()->create(['name' => 'Грузовые']);

        $passengerCar = $cars->children()->create(['name' => 'Легковые']);

        Activity::factory()->create(['name' => 'Запчасти', 'parent_id' => $passengerCar->id]);
        Activity::factory()->create(['name' => 'Аксессуары', 'parent_id' => $passengerCar->id]);
    }
}
