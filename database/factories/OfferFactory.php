<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OfferFactory extends Factory
{
    protected $model = Offer::class;

    public function definition(): array
    {
        return [
            'seller_id' => Seller::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'amount' => fake()->randomFloat(2),
            'count' => fake()->randomNumber(5, true)
        ];
    }
}

