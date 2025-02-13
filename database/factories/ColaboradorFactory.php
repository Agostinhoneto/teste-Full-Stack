<?php

namespace Database\Factories;

use App\Models\Colaborador;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Colaborador>
 */
class ColaboradorFactory extends Factory
{
    protected $model = Colaborador::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'usuario_cadastrante_id' => 1,
            'usuario_alterante_id' => 1,
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->numerify('###########'),
            'unidade_id' => $this->faker->randomDigitNotNull(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
