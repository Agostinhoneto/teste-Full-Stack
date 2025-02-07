<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandeiraSeeder extends Seeder
{
    public function run()
    {
        DB::table('bandeiras')->insert([
            [
                'id' => 1,
                'nome' => 'bandeira teste',
                'grupo_economico_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}