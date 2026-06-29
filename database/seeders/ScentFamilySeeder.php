<?php

namespace Database\Seeders;

use App\Models\ScentFamily;
use Illuminate\Database\Seeder;

class ScentFamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            "Oud & Bakhoor", "Floral", "Oriental", "Woody", "Fresh & Aquatic",
            "Citrus", "Gourmand", "Spicy", "Musky", "Fougere",
            "Chypre", "Aromatic", "Green", "Powdery", "Leather"
        ];

        foreach ($families as $i => $name) {
            ScentFamily::create([
                "name" => $name, 
                "sort_order" => $i, 
                "is_active" => true
            ]);
        }
    }
}
