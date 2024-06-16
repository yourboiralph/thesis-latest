<?php

namespace Database\Seeders;


use App\Models\User;
use App\Models\Train;
use App\Models\Notification;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 users
        $users = User::factory(10)->create();

        // Create 5 trains
        $trains = Train::factory(5)->create();

        // Create 20 notifications
        Notification::factory(20)->create([
            'motion_detected' => function () use ($trains) {
                return $trains->random()->motion_name;
            },
            'level' => function (array $attributes) use ($trains) {
                $train = $trains->where('motion_name', $attributes['motion_detected'])->first();
                return $train ? $train->level : 'normal';
            },
            'user_id' => function () use ($users) {
                return $users->random()->user_id;
            },
        ]);
    }
}
