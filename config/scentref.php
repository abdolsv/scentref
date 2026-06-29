<?php

return [

    "jumia_aff_id"    => env("JUMIA_AFF_ID", ""),
    "konga_ref"       => env("KONGA_REF", ""),

    "brand_tiers" => [
    
        "luxury"             => [
            "label" => "Luxury",             
            "color" => "purple"
            ],
            
        "designer"           => [
            "label" => "Designer",           
            "color" => "blue"
            ],
            
        "niche"              => [
            "label" => "Niche",              
            "color" => "gold"
            ],
            
        "accessible_designer"=> [
            "label" => "Accessible Designer",
            "color" => "green"
            ],
            
        "budget"             => [
            "label" => "Budget",             
            "color" => "gray"
            ],
            
        "arabian"            => [
            "label" => "Arabian",            
            "color" => "amber"
            ],
    ],

    "nigeria_cities" => ["Lagos", "Abuja", "Port Harcourt", "Kano", "Ibadan",
                          "Enugu", "Kaduna", "Warri", "Calabar", "Owerri"],

    "price_tiers" => [
        "under_3000"  => ["label" => "Under ₦3,000",  "min" => 0,     "max" => 2999],
        "3k_to_7k"    => ["label" => "₦3,000–₦7,000", "min" => 3000,  "max" => 7000],
        "7k_to_15k"   => ["label" => "₦7,000–₦15,000","min" => 7001,  "max" => 15000],
        "15k_to_30k"  => ["label" => "₦15,000–₦30,000","min" => 15001,"max" => 30000],
        "above_30k"   => ["label" => "Above ₦30,000", "min" => 30001, "max" => 9999999],
    ],

    "cache_ttl" => [
        "perfume_page"   => 86400,    // 24 hours
        "brand_archive"  => 43200,    // 12 hours
        "filter_result"  => 3600,     // 1 hour
        "sitemap"        => 21600,    // 6 hours
    ],
];

