<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    public function run()
    {
     
        DB::table('unidades')->insert([
            [
                'id' => 1,
                'nome_fantasia' => 'Loja Centro',
                'razao_social' => 'Loja Centro Ltda',
                'cnpj' => '12345678000101',
                'bandeira_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nome_fantasia' => 'Loja Norte',
                'razao_social' => 'Loja Norte Ltda',
                'cnpj' => '98765432000199',
                'bandeira_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}