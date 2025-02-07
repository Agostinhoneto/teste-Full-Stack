<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnidadeSeeder extends Seeder
{
    public function run()
    {
        $bandeiraAzul = DB::table('bandeiras')->where('nome', 'Bandeira Azul')->first();
        $bandeiraVerde = DB::table('bandeiras')->where('nome', 'Bandeira Verde')->first();

        DB::table('unidades')->insert([
            [
                'nome_fantasia' => 'Loja Centro',
                'razao_social' => 'Loja Centro Ltda',
                'cnpj' => '12345678000101',
                'bandeira_id' => $bandeiraAzul->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nome_fantasia' => 'Loja Norte',
                'razao_social' => 'Loja Norte Ltda',
                'cnpj' => '98765432000199',
                'bandeira_id' => $bandeiraVerde->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}