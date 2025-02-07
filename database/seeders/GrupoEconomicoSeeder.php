<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoEconomicoSeeder extends Seeder
{
    public function run()
    {
        DB::table('grupos_economicos')->insert([
            [
                'id' => 1,
                'nome' => 'teste',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}