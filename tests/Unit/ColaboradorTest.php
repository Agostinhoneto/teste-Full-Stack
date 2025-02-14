<?php

namespace Tests\Unit;

use App\Models\Colaborador;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColaboradorTest extends TestCase
{

    /** @test */
    public function pode_criar_um_colaborador()
    {
        $colaborador = new Colaborador([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'João Silva',
            'email' => 'teste@emailtestexx.com',
            'cpf' => '987.654.321-00',
            'unidade_id' => 1,
        ]);
        $colaborador->save();

        $this->assertDatabaseHas('colaboradores', ['email' => 'teste@emailtestexx.com']);
    }

    /** @test */
    public function pode_atualizar_um_colaborador()
    {
        $colaborador = Colaborador::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'João Silva',
            'email' => 'joao@emailtestezz.com',
            'cpf' => '123.456.789-00',
            'unidade_id' => 1,
        ]);

        $colaborador->update([
            'nome' => 'João Silva Atualizado',
            'email' => 'joaoatualizado@emailtestezz.com',
        ]);

        $this->assertDatabaseHas('colaboradores', ['email' => 'joaoatualizado@emailtestezz.com']);
    }

    /** @test */
    public function pode_deletar_um_colaborador()
    {
        $colaborador = Colaborador::create([
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => 'João Silva',
            'email' => 'joao1@emailtestexx.com',
            'cpf' => '999.456.789-00',
            'unidade_id' => 1,
        ]);

        $colaborador->delete();

        $this->assertDatabaseMissing('colaboradores', ['email' => 'joao1@emailtestexx.com']);
    }
}
