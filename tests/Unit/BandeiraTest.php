<?php

namespace Tests\Unit;

use App\Models\Bandeira;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BandeiraTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pode_criar_uma_bandeira()
    {
        $bandeira = new Bandeira();
        $bandeira->nome = 'Bandeira Exemplo';
        $bandeira->save();

        $this->assertDatabaseHas('bandeiras', ['nome' => 'Bandeira Exemplo']);
    }
}
