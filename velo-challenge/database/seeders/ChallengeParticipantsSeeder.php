<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChallengeParticipantsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('challenge_participants')->insert([
            [
                'user_id' => 1,
                'challenge_id' => 2,
                'joined_at' => now()
            ],
            [
                'user_id' => 2,
                'challenge_id' => 3,
                'joined_at' => now()
            ],
            [
                'user_id' => 3,
                'challenge_id' => 1,
                'joined_at' => now()
            ],
            [
                'user_id' => 4,
                'challenge_id' => 2,
                'joined_at' => now()
            ],
            [
                'user_id' => 5,
                'challenge_id' => 3,
                'joined_at' => now()
            ],
            /*
            [
                'user_id' => 4,
                'challenge_id' => 1,
                'joined_at' => now()
            ],
            [
                'user_id' => 5,
                'challenge_id' => 1,
                'joined_at' => now()
            ],*/    
        ]);
    }
}
