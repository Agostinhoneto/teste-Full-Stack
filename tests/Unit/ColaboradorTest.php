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
            'email' => 'joao@emailteste.com',
            'cpf' => '123.456.789-00',
            'unidade_id' => 1,
        ]);
        $colaborador->save();

        $this->assertDatabaseHas('colaboradores', ['email' => 'joao@email.com']);
    }
}
