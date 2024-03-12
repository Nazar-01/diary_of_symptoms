<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Symptom;

/**
* @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Symptom>
*/
class SymptomFactory extends Factory
{

  protected $model = Symptom::class;

  /**
  * Define the model's default state.
  *
  * @return array<string, mixed>
  */
  public function definition(): array
  {
    return [
      'name' => $this->faker->sentence,
      'description' => $this->faker->paragraph,
      'rating' => $this->faker->numberBetween(0, 10),
      'user_id' => $this->faker->numberBetween(1, 1),
    ];
  }
}
