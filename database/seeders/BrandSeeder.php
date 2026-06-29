<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            ["name" => "Lattafa", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Armaf", "tier" => "accessible_designer", "origin_country" => "UAE"],
            ["name" => "Al Haramain", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Swiss Arabian", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Rasasi", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Paris Corner", "tier" => "budget", "origin_country" => "UAE"],
            ["name" => "Afnan", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Khadlaj", "tier" => "arabian", "origin_country" => "UAE"],
            ["name" => "Davidoff", "tier" => "accessible_designer", "origin_country" => "Switzerland"],
            ["name" => "Lacoste", "tier" => "accessible_designer", "origin_country" => "France"],
            ["name" => "Paco Rabanne", "tier" => "accessible_designer", "origin_country" => "France"],
            ["name" => "Azzaro", "tier" => "accessible_designer", "origin_country" => "France"],
            ["name" => "Joop", "tier" => "accessible_designer", "origin_country" => "Germany"],
            ["name" => "Chanel", "tier" => "luxury", "origin_country" => "France"],
            ["name" => "Dior", "tier" => "luxury", "origin_country" => "France"],
            ["name" => "Tom Ford", "tier" => "luxury", "origin_country" => "USA"],
            ["name" => "YSL", "tier" => "luxury", "origin_country" => "France"],
            ["name" => "Giorgio Armani", "tier" => "designer", "origin_country" => "Italy"],
            ["name" => "Creed", "tier" => "luxury", "origin_country" => "UK"],
            ["name" => "Maison Alhambra", "tier" => "budget", "origin_country" => "UAE"],
        ];

        foreach ($brands as $brand) {
            Brand::create(array_merge($brand, ["is_active" => true]));
        }
    }
}
