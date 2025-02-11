<?php

namespace Tests\Unit;

use App\Models\Colaborador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColaboradorTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_um_colaborador()
    {
        $colaborador = Colaborador::factory()->create([
            'nome' => 'João Silva',
            'email' => 'joao@email.com',
        ]);

        $this->assertDatabaseHas('colaboradores', ['email' => 'joao@email.com']);
    }
}
