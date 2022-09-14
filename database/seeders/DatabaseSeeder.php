<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\Product;
use App\Models\Offer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Seller::factory()->count(1000)->create();
        Product::factory()->count(1000)->create();
        Offer::factory()->count(1000)->create();
    }
}
