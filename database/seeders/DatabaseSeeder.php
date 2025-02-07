<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use BandeiraSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
       
    public function run()
    {
        $this->call([
            BandeiraSeeder::class,
            GrupoEconomicoSeeder::class,
            ColaboradorSeeder::class,
            UnidadeSeeder::class,
        ]);
    }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    
}
