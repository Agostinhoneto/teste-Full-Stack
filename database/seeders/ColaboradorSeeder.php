<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColaboradorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
  
        public function run()
        {
           
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
            ]);
        }
}
