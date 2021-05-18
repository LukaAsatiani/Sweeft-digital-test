<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory{
  protected $model = Product::class;

  public function definition(){
    return [
      'title' => $this->faker->word,
      'description' => $this->faker->sentence,
      'price' => $this->faker->randomFloat(2, 10000, 10),
      'currency' => $this->faker->randomElement(['GEL', 'EUR', 'USD'])
    ];
  }
}
