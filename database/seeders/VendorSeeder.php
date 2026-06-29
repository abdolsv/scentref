<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendors = [
            [
                "name" => "Jumia", 
                "type" => "marketplace", 
                "website_url" => "https://www.jumia.com.ng",
                "affiliate_param" => "aff_id", 
                "is_verified" => true
            ],
            [
                "name" => "Konga", 
                "type" => "marketplace", 
                "website_url" => "https://www.konga.com",
                "affiliate_param" => "ref", 
                "is_verified" => true
            ],
            [
                "name" => "Jiji", 
                "type" => "marketplace", 
                "website_url" => "https://jiji.ng", 
                "is_verified" => false
            ],
            [
                "name" => "Trade Fair (Physical)", 
                "type" => "physical", 
                "is_verified" => false
            ],
            [
                "name" => "Scentronics", 
                "type" => "dedicated", 
                "website_url" => "https://scentronics.ng", 
                "is_verified" => true
            ],
        ];

        foreach ($vendors as $vendor) {
            Vendor::create(array_merge($vendor, ["is_active" => true]));
        }
    }
}
