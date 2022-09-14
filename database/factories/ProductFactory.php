<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = fake()->words(3, true);
        return [
            'name' => $name,
            'description' => fake()->paragraph(),
            'image' => fake()->imageUrl(640, 480, $name, true),
            'article' => fake()->bothify('??-#######')
        ];
    }
}
