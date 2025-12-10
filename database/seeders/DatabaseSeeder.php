<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Database\Seeders\RolesSeeder;
use Database\Seeders\EstadosEntradaSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         // seeder
         $this->call([
            RolesSeeder::class,
            EstadosEntradaSeeder::class,
        ]);

         // User::factory(10)->create();

         User::factory()->create([
            'name' => 'santi',
            'email' => 'santidejesus@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // admin
        ]);

        User::factory()->create([
            'name' => 'joel',
            'email' => 'joel@gmail.com',
            'password' => Hash::make('1234567'),
            'role_id' => 2, // organizador
        ]);

        User::factory()->create([
            'name' => 'juance',
            'email' => 'juance@gmail.com',
            'password' => Hash::make('1234567'),
            'role_id' => 2, // organizador
        ]);

      


    }
}
