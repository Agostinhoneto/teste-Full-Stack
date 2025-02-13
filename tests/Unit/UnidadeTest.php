<?php

namespace Tests\Unit;

use App\Models\Unidade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UnidadeTest extends TestCase
{

    /** @test */
    public function pode_criar_uma_unidade()
    {
        $unidade = Unidade::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 2,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '00.000.000/0000-00',
            'bandeira_id' => 1,
        ]);

        $this->assertDatabaseHas('unidades', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 2,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '00.000.000/0000-00',
            'bandeira_id' => 1,
        ]);
    }
}
