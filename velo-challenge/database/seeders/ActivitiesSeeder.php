<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActivitiesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('activities')->insert([
            [
                'user_id' => 1,
                'challenge_id' => 2,
                'date' => '2025-06-02',
                'distance_km' => 15.48,
                'rain' => 0,
                'night' => 1,
                'with_kids' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'challenge_id' => 3,
                'date' => '2025-06-03',
                'distance_km' => 19.29,
                'rain' => 0,
                'night' => 1,
                'with_kids' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'challenge_id' => 1,
                'date' => '2025-06-04',
                'distance_km' => 10.53,
                'rain' => 0,
                'night' => 1,
                'with_kids' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 4,
                'challenge_id' => 2,
                'date' => '2025-06-05',
                'distance_km' => 15.02,
                'rain' => 0,
                'night' => 1,
                'with_kids' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 5,
                'challenge_id' => 3,
                'date' => '2025-06-06',
                'distance_km' => 10.63,
                'rain' => 1,
                'night' => 0,
                'with_kids' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
