<?php

namespace Tests\Unit;

use App\Models\Bandeira;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BandeiraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_uma_bandeira()
    {
        $bandeira = new Bandeira();
        $bandeira->usuario_cadastrante_id = 1;
        $bandeira->usuario_alterante_id = 1;
        $bandeira->nome = 'Bandeira Exemplo';
        $bandeira->grupo_economico_id = 1;
        $bandeira->save();

        $this->assertDatabaseHas('bandeiras', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Bandeira Exemplo',
            'grupo_economico_id' => 1,
        ]);
    }
}
