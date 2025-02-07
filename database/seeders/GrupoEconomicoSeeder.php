<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColaboradorSeeder extends Seeder
{
    public function run()
    {
        $lojaCentro = DB::table('unidades')->where('nome_fantasia', 'Loja Centro')->first();
        $lojaNorte = DB::table('unidades')->where('nome_fantasia', 'Loja Norte')->first();

        DB::table('colaboradores')->insert([
            [
                'nome' => 'João Silva',
                'email' => 'joao@email.com',
                'cpf' => '11122233344',
                'unidade_id' => $lojaCentro->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome' => 'Maria Oliveira',
                'email' => 'maria@email.com',
                'cpf' => '55566677788',
                'unidade_id' => $lojaNorte->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}