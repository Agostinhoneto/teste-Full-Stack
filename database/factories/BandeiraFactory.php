<?php

namespace Database\Factories;

use App\Models\Bandeira;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bandeira>
 */
class BandeiraFactory extends Factory
{

    protected $model = Bandeira::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'usuario_cadastrante_id' => $this->faker->randomDigitNotNull(),
            'usuario_alterante_id' => $this->faker->randomDigitNotNull(),
            'nome' => $this->faker->word(),
            'grupo_economico_id' => $this->faker->randomDigitNotNull(),
        ];
    }
}
