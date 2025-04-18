<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "unit_id" => 1,
            "name" => "Beras Pin-pin",
            "price" => 20000,
            "image" => "PRODUCT_IMAGE_20250416104254.jpg",
            "is_active" => 1,
        ]);

        Product::create([
            "unit_id" => 3,
            "name" => "Minyak Bimoli",
            "price" => 30000,
            "image" => "PRODUCT_IMAGE_20250416052128.jpg",
            "is_active" => 1,
        ]);
    }
}
