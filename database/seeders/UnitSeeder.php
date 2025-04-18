<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Unit::create([
            "name" => "Kilogram",
            "abbr" => "Kg",
        ]);

        Unit::create([
            "name" => "Liter",
            "abbr" => "L",
        ]);

        Unit::create([
            "name" => "Pieces",
            "abbr" => "Pcs",
        ]);
    }
}
