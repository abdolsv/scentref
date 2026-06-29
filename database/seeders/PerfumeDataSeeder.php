<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Perfume;
use Illuminate\Database\Seeder;
use Laravel\Scout\ModelObserver; // Import the observer

class PerfumeDataSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Ensure Brand exists
        $brand = Brand::updateOrCreate(['name' => 'Tom Ford'], [
            'slug' => 'tom-ford',
        ]);

        // 2. Define Data
        $perfumes = [
            [
                'name' => 'Oud Wood',
                'slug' => 'oud-wood',
                'brand_id' => $brand->id,
                'gender_target' => 'unisex',
                'concentration' => 'edp',
                'availability' => 'available',
                'year_released' => 2007,
                'official_description' => 'A smoky, woody fragrance with a touch of exotic spice.',
                'pw_rating' => 5,
                'is_published' => 1,
                'is_complete' => 1,
                'longevity_heat' => 8,
                'longevity_ac' => 9,
                'longevity_hours_avg' => 8.5,
                'sillage_rating' => 7,
                'projection' => 'moderate',
                'best_season_nigeria' => json_encode(['harmattan', 'rainy']),
                'best_occasion' => json_encode(['evening', 'formal']),
                'physical_store_cities' => json_encode(['Lagos', 'Abuja']),
            ]
        ];

        // 3. Insert data while disabling Scout indexing
        Perfume::withoutSyncingToSearch(function () use ($perfumes) {
            foreach ($perfumes as $data) {
                Perfume::updateOrCreate(['slug' => $data['slug']], $data);
            }
        });
    }
}
