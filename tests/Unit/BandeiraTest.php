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
        // Criar um Grupo Econômico antes de usar a foreign key
        $grupo = \App\Models\GrupoEconomico::factory()->create();

        // Criar a Bandeira associada ao Grupo Econômico
        $bandeira = new \App\Models\Bandeira();
        $bandeira->usuario_cadastrante_id = 1;
        $bandeira->usuario_alterante_id = 1;
        $bandeira->nome = 'Bandeira Exemplo';
        $bandeira->grupo_economico_id = $grupo->id;
        $bandeira->save();

        // Verificar se foi inserido corretamente
        $this->assertDatabaseHas('bandeiras', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Bandeira Exemplo',
            'grupo_economico_id' => $grupo->id,
        ]);
    }
}
