<?php

namespace Database\Factories;
use App\Models\Alumno;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
protected $model = Alumno::class;

    public function definition()
    {
        /**return [
            'nombre' => $this->faker->sentence(),
            'apellido'  => $this->faker->sentence(),
            'edad' => $this->faker->randomDigit(),
            'ci'=> $this->faker->randomDigit(),
            'telefono' => $this->faker->randomDigit(),
            'direccion' => $this->faker->sentence(),
            'gmail' => $this->faker->sentence(),
            'profesion' => $this->faker->sentence(),
            'genero' => $this->faker->sentence(),
            'fechanac' => $this->faker->sentence(),
         




        ]; */
    }
}
