<?php

namespace Tests\Unit;

use App\Models\GrupoEconomico;
use Tests\TestCase;

class GrupoEconomicoTest extends TestCase
{

    /** @test */
    public function pode_criar_um_grupo_economico()
    {
        $grupo = new GrupoEconomico();
        $grupo->usuario_cadastrante_id = 1;
        $grupo->usuario_alterante_id = 1;
        $grupo->nome = 'Grupo Exemplo';
        $grupo->save();

        $this->assertDatabaseHas('grupos_economicos', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Grupo Exemplo'
        ]);
    }

    /** @test */
    public function pode_atualizar_um_grupo_economico()
    {
        $grupo = GrupoEconomico::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Grupo Exemplo'
        ]);

        $grupo->nome = 'Grupo Atualizado';
        $grupo->save();

        $this->assertDatabaseHas('grupos_economicos', [
            'id' => $grupo->id,
            'nome' => 'Grupo Atualizado'
        ]);
    }

    /** @test */
    public function pode_deletar_um_grupo_economico()
    {
        $grupo = GrupoEconomico::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'Grupo Exemplo'
        ]);

        $grupo->delete();

        $this->assertDatabaseMissing('grupos_economicos', [
            'id' => $grupo->id
        ]);
    }
}
