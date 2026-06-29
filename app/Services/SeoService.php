<?php

namespace App\Services;

use App\Models\{Brand, Note, Perfume, ScentFamily};
use Illuminate\Support\Facades\Storage;

class SeoService
{
    public function forPerfume(Perfume $p): array
    {
        $brand    = $p->brand?->name ?? "";
        $minPrice = $p->currentPrices->min("price_ngn");
        $maxPrice = $p->currentPrices->max("price_ngn");
        $reviews  = $p->approvedReviews;

        // Ensure we are working with an array for notes before imploding
        $notesList = $p->notes ? $p->notes->pluck('name')->implode(', ') : '';

        return [
            "title" => $p->meta_title ?? "{$p->name} by {$brand} — Price in Nigeria, Reviews & Where to Buy | ScentRef",
            "description" => $p->meta_description ??
                "{$p->name} by {$brand} — Nigeria price from ₦".number_format($minPrice ?? 0).
                " to ₦".number_format($maxPrice ?? 0).". Scent profile notes: {$notesList}. Longevity ratings.",
            "canonical" => url("/perfume/{$p->slug}"),
            "og_image"  => $p->bottle_image_path ? Storage::url($p->bottle_image_path) : null,
            "jsonLd"    => [
                $this->productSchema($p, $brand, $reviews, $notesList),
                $this->buildFaqSchema($p, $notesList),
                $this->buildBreadcrumbSchema($p, $brand),
            ],
        ];
    }

    private function productSchema(Perfume $p, string $brand, $reviews, string $notesList): array
    {
        $schema = [
            "@context" => "https://schema.org",
            "@type"    => "Product",
            "name"     => $p->name,
            "brand"    => ["@type" => "Brand", "name" => $brand],
            "description" => strip_tags($p->review_summary ?? ""),
            "keywords" => $notesList,
        ];
        if ($p->bottle_image_path) {
            $schema["image"] = Storage::url($p->bottle_image_path);
        }
        if ($p->currentPrices->isNotEmpty()) {
            $schema["offers"] = $p->currentPrices->map(fn($price) => [
                "@type"           => "Offer",
                "seller"          => ["@type"=>"Organization","name"=>$price->vendor?->name],
                "price"           => (string)$price->price_ngn,
                "priceCurrency"   => "NGN",
                "url"             => $price->affiliate_url,
                "availability"    => "https://schema.org/InStock",
                "priceValidUntil" => now()->addMonth()->toDateString(),
            ])->toArray();
        }
        if ($reviews->count() >= 3) {
            $schema["aggregateRating"] = [
                "@type"       => "AggregateRating",
                "ratingValue" => round($reviews->avg("rating_overall"), 1),
                "reviewCount" => $reviews->count(),
                "bestRating"  => "10",
                "worstRating" => "1",
            ];
        }
        return $schema;
    }

    private function buildFaqSchema(Perfume $p, string $notesList): array
    {
        // DEFENSIVE FIX: Ensure physical_store_cities is an array
        $citiesData = $p->physical_store_cities;
        $citiesArray = is_array($citiesData) ? $citiesData : (json_decode($citiesData, true) ?? []);
        
        $cities = !empty($citiesArray) 
            ? implode(", ", $citiesArray) 
            : "online via Jumia and Konga";

        $minPrice = $p->currentPrices->min("price_ngn");

        $faq = [
            "@context" => "https://schema.org",
            "@type"    => "FAQPage",
            "mainEntity" => [
                ["@type"=>"Question","name"=>"Is {$p->name} available in Nigeria?",
                 "acceptedAnswer"=>["@type"=>"Answer","text"=>match($p->availability){
                    "available"     => "{$p->name} is available in Nigeria at {$cities}.",
                    "import_only"   => "{$p->name} is available via import or specialist vendors.",
                    "not_available" => "{$p->name} is not currently available in Nigeria.",
                    default         => "{$p->name} availability in Nigeria is being confirmed.",
                 }]],
                ["@type"=>"Question","name"=>"How long does {$p->name} last in Nigerian heat?",
                 "acceptedAnswer"=>["@type"=>"Answer","text"=>
                    "{$p->name} has a Nigerian heat longevity rating of {$p->longevity_heat}/10, 
                    lasting approximately {$p->longevity_hours_avg} hours outdoors."]],
                ["@type"=>"Question","name"=>"What is the price of {$p->name} in Nigeria?",
                 "acceptedAnswer"=>["@type"=>"Answer","text"=>
                    "As of ".($p->last_price_updated?->format("F Y") ?? "current date").
                    ", {$p->name} is priced from ₦".number_format($minPrice ?? 0)." in Nigeria."]],
            ]
        ];

        if (!empty($notesList)) {
            $faq["mainEntity"][] = [
                "@type" => "Question",
                "name" => "What are the fragrance notes of {$p->name}?",
                "acceptedAnswer" => [
                    "@type" => "Answer",
                    "text" => "The dominant olfactory notes featured in {$p->name} include: {$notesList}."
                ]
            ];
        }

        return $faq;
    }

    private function buildBreadcrumbSchema(Perfume $p, string $brand): array
    {
        return [
            "@context" => "https://schema.org",
            "@type"    => "BreadcrumbList",
            "itemListElement" => [
                ["@type"=>"ListItem","position"=>1,"name"=>"Home","item"=>url("/")],
                ["@type"=>"ListItem","position"=>2,"name"=>"Perfumes","item"=>url("/perfume")],
                ["@type"=>"ListItem","position"=>3,"name"=>$brand,"item"=>url("/brand/{$p->brand?->slug}")],
                ["@type"=>"ListItem","position"=>4,"name"=>$p->name,"item"=>url("/perfume/{$p->slug}")],
            ]
        ];
    }

    public function forBrand(Brand $b, int $count): array
    {
        return [
            "title"       => "{$b->name} Perfumes in Nigeria 2026 — Prices & Reviews | ScentRef",
            "description" => "Browse all {$count} {$b->name} perfumes with current NGN prices, longevity ratings for Nigerian weather, and verified buyer reviews.",
            "canonical"   => url("/brand/{$b->slug}"),
        ];
    }

    public function forScentFamily(ScentFamily $sf, int $count): array
    {
        return [
            "title"       => "Best {$sf->name} Perfumes in Nigeria 2026 | ScentRef",
            "description" => "{$count} {$sf->name} fragrances available in Nigeria with Nigerian prices and climate performance ratings.",
            "canonical"   => url("/scent/{$sf->slug}"),
        ];
    }

    public function forNote(Note $n, int $count): array
    {
        return [
            "title"       => "Perfumes with {$n->name} Note in Nigeria — Prices & Reviews | ScentRef",
            "description" => "All {$count} perfumes featuring {$n->name} available in Nigeria, with current NGN prices.",
            "canonical"   => url("/note/{$n->slug}"),
        ];
    }
}
