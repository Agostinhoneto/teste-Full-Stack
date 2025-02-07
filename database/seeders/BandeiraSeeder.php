<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandeiraSeeder extends Seeder
{
    public function run()
    {
        DB::table('bandeiras')->insert([
            [
                'id' => 1,
                'nome' => 'Bandeira 1',
                'grupo_economico_id' => 1,
            ],

        ]);
    }
}
