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

        DB::table('colaboradores')->insert([
            [
                'id' => 1,
                'nome' => 'João Silva',
                'email' => 'joao@email.com',
                'cpf' => '11122233344',
                'unidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nome' => 'Maria Oliveira',
                'email' => 'maria@email.com',
                'cpf' => '55566677788',
                'unidade_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}