<?php

namespace Tests\Unit;

use App\Models\GrupoEconomico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GrupoEconomicoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_um_grupo_economico()
    {
        $grupo = new GrupoEconomico();
        $grupo->nome = 'Grupo Exemplo';
        $grupo->save();

        $this->assertDatabaseHas('grupos_economicos', ['nome' => 'Grupo Exemplo']);
    }
}
