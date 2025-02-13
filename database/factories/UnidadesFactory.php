<?php

namespace Database\Factories;

use App\Models\Unidade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UnidadesFactory extends Factory
{

    protected $model = Unidade::class;


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'usuario_cadastrante_id' => $this->faker->randomDigitNotNull,
            'usuario_alterante_id' => $this->faker->randomDigitNotNull,
            'nome_fantasia' => $this->faker->company,
            'razao_social' => $this->faker->company . ' Ltda',
            'cnpj' => $this->faker->numerify('##.###.###/####-##'),
            'bandeira_id' => $this->faker->randomDigitNotNull,
        ];
    }
}
