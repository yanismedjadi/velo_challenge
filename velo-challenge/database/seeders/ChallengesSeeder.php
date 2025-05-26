<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('challenges')->insert([
            [
                'title' => 'Challenge 0',
                'description' => 'Description du challenge 0',
                'category' => 'Compétition',
                'difficulty' => 'avance',
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-30',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Challenge 1',
                'description' => 'Description du challenge 1',
                'category' => 'Loisir',
                'difficulty' => 'avance',
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-30',
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Challenge 2',
                'description' => 'Description du challenge 2',
                'category' => 'Sport',
                'difficulty' => 'intermediaire',
                'start_date' => '2025-06-01',
                'end_date' => '2025-06-30',
                'created_by' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
