<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BandeiraSeeder extends Seeder
{
    public function run()
    {
        $grupoAlpha = DB::table('grupos_economicos')->where('nome', 'Grupo Alpha')->first();
        $grupoBeta = DB::table('grupos_economicos')->where('nome', 'Grupo Beta')->first();

        DB::table('bandeiras')->insert([
            ['nome' => 'Bandeira Azul', 'grupo_economico_id' => $grupoAlpha->id, 'created_at' => now(), 'updated_at' => now()],
            ['nome' => 'Bandeira Verde', 'grupo_economico_id' => $grupoBeta->id, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
