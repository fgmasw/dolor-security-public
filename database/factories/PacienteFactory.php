<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PacienteFactory extends Factory
{
    protected $model = \App\Models\Paciente::class;

    public function definition()
    {
        return [
            'rol' => $this->faker->unique()->word,
            'nombre' => $this->faker->name,
            'edad' => $this->faker->numberBetween(1, 100),
            'rut' => $this->faker->unique()->numerify('########-#'),
            'prevision' => $this->faker->word,
            'cama_hospitalizacion' => $this->faker->randomElement(['A1', 'B2', 'C3']),
            'diagnostico' => $this->faker->sentence,
            'cirujano' => $this->faker->name,
            'cirugia' => $this->faker->word,
            'tratamiento_modalidad' => $this->faker->word,
            'tratamiento_medicamento' => $this->faker->word,
            'tipo_bloqueo' => $this->faker->word,
            'factores_riesgo' => [
                'DM' => $this->faker->randomElement(['Sí', 'No']),
                'Inmunodeprimido' => $this->faker->randomElement(['Sí', 'No']),
                'Uso corticoides crónico' => $this->faker->randomElement(['Sí', 'No']),
                'Hiperglicemia >200ug/dL preoperatoria' => $this->faker->randomElement(['Sí', 'No']),
                'Hospitalización en UCI durante la hospitalización actual' => $this->faker->randomElement(['Sí', 'No']),
            ],
        ];
    }
}
