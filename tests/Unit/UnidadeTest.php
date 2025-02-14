<?php

namespace Tests\Unit;

use App\Models\Unidade;
use Tests\TestCase;

class UnidadeTest extends TestCase
{
    /** @test */
    public function pode_criar_uma_unidade()
    {
        $unidade = Unidade::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '00.000.000/0000-00',
            'bandeira_id' => 1,
        ]);

        $this->assertDatabaseHas('unidades', [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '00.000.000/0000-00',
            'bandeira_id' => 1,
        ]);
    }

    /** @test */
    public function pode_atualizar_uma_unidade()
    {
        $unidade = Unidade::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '99.000.000/0000-00',
            'bandeira_id' => 1,
        ]);

        $unidade->update([
            'nome_fantasia' => 'Nome Fantasia Atualizado',
        ]);

        $this->assertDatabaseHas('unidades', [
            'id' => $unidade->id,
            'nome_fantasia' => 'Nome Fantasia Atualizado',
        ]);
    }

    /** @test */
    public function pode_deletar_uma_unidade()
    {
        $unidade = Unidade::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome_fantasia' => 'Nome Fantasia Teste',
            'razao_social' => 'Razao Social Teste',
            'cnpj' => '00.000.000/0000-99',
            'bandeira_id' => 1,
        ]);

        $unidade->delete();

        $this->assertDatabaseMissing('unidades', [
            'id' => $unidade->id,
        ]);
    }
}
