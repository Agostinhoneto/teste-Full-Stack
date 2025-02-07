<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoEconomicoSeeder extends Seeder
{
    public function run()
    {
       // $lojaCentro = DB::table('unidades')->where('nome_fantasia', 'Loja Centro')->first();
        //$lojaNorte = DB::table('unidades')->where('nome_fantasia', 'Loja Norte')->first();

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