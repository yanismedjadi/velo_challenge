<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Prenom0',
                'last_name' => 'Nom0',
                'email' => 'user0@example.com',
                'password_hash' => Hash::make('password'),
                'gender' => 'Homme',
                'birth_date' => '1990-01-01',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Prenom1',
                'last_name' => 'Nom1',
                'email' => 'user1@example.com',
                'password_hash' => Hash::make('password'),
                'gender' => 'Homme',
                'birth_date' => '1991-01-01',
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Prenom2',
                'last_name' => 'Nom2',
                'email' => 'user2@example.com',
                'password_hash' => Hash::make('password'),
                'gender' => 'Femme',
                'birth_date' => '1992-01-01',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Prenom3',
                'last_name' => 'Nom3',
                'email' => 'user3@example.com',
                'password_hash' => Hash::make('password'),
                'gender' => 'Homme',
                'birth_date' => '1993-01-01',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Prenom4',
                'last_name' => 'Nom4',
                'email' => 'user4@example.com',
                'password_hash' => Hash::make('password'),
                'gender' => 'Femme',
                'birth_date' => '1994-01-01',
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
