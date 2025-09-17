<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $roles = [
            ['id' => 1, 'nombre' => 'admin'],
            ['id' => 2, 'nombre' => 'organizador'],
            ['id' => 3, 'nombre' => 'cliente'],
        ];

        foreach ($roles as $rol) {
            DB::table('roles')->updateOrInsert(
                ['id' => $rol['id']],
                ['nombre' => $rol['nombre']]
            );
        }
    }
}
