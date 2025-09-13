<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        


          DB::table('roles')->insert([
            ['id' => 1, 'nombre' => 'admin'],
            ['id' => 2, 'nombre' => 'organizador'],
            ['id' => 3, 'nombre' => 'cliente'],
        ]);

         // User::factory(10)->create();

         User::factory()->create([
            'name' => 'santi',
            'email' => 'santidejesus@gmail.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // admin
        ]);


    }
}
