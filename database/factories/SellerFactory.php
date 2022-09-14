<?php

namespace Database\Factories;

use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SellerFactory extends Factory
{
    protected $model = Seller::class;

    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'image' => fake()->imageUrl(300, 100, $name, true),
            'token' => hash('sha256', $name),
        ];
    }
}
