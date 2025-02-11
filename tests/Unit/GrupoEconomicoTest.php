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
        $grupo = GrupoEconomico::factory()->create([
            'nome' => 'Grupo Exemplo',
        ]);

        $this->assertDatabaseHas('grupos_economicos', ['nome' => 'Grupo Exemplo']);
    }
}
