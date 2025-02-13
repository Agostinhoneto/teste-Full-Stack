<?php

namespace Tests\Unit;

use App\Models\Unidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnidadeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_uma_unidade()
    {
        $unidade = Unidade::create([
            'nome' => 'Unidade Teste',
        ]);

        $this->assertDatabaseHas('unidades', ['nome' => 'Unidade Teste']);
    }
}
