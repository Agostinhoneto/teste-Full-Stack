<?php

namespace Tests\Unit;

use App\Models\Bandeira;
use Tests\TestCase;
use RefreshDatabase;

class BandeiraTest extends TestCase
{
    /** @test */
    public function pode_criar_uma_bandeira()
    {
        $grupo = \App\Models\GrupoEconomico::factory()->create();

        $bandeira = new \App\Models\Bandeira();
        $bandeira->usuario_cadastrante_id = 1;
        $bandeira->usuario_alterante_id = 1;
        $bandeira->nome = 'Bandeira Exemplo';
        $bandeira->grupo_economico_id = $grupo->id;
        $bandeira->save();

        $this->assertDatabaseHas('bandeiras', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Bandeira Exemplo',
            'grupo_economico_id' => $grupo->id,
        ]);
    }

    /** @test */
    public function pode_atualizar_uma_bandeira()
    {
        $grupo = \App\Models\GrupoEconomico::factory()->create();

        $bandeira = \App\Models\Bandeira::factory()->create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Bandeira Exemplo',
            'grupo_economico_id' => $grupo->id,
        ]);

        $bandeira->nome = 'Bandeira Atualizada';
        $bandeira->save();

        $this->assertDatabaseHas('bandeiras', [
            'id' => $bandeira->id,
            'nome' => 'Bandeira Atualizada',
        ]);
    }

    /** @test */
    public function pode_deletar_uma_bandeira()
    {
        $grupo = \App\Models\GrupoEconomico::factory()->create();

        $bandeira = \App\Models\Bandeira::factory()->create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Bandeira Exemplo',
            'grupo_economico_id' => $grupo->id,
        ]);

        $bandeira->delete();

        $this->assertDatabaseMissing('bandeiras', [
            'id' => $bandeira->id,
        ]);
    }
}
