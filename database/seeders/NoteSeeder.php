<?php
// database/seeders/NoteSeeder.php
namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $notes = [
            // ── TOP NOTES ──────────────────────────────────────────────
            // Citrus family
            ['name' => 'Bergamot',     'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Lemon',        'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Grapefruit',   'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Mandarin',     'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Orange',       'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Lime',         'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Petitgrain',   'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Yuzu',         'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Neroli',       'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Tangerine',    'family' => 'citrus', 'typical_position' => 'top'],
            ['name' => 'Blood Orange', 'family' => 'citrus', 'typical_position' => 'top'],

            // Fresh / Green top
            ['name' => 'Green Tea',      'family' => 'earthy',  'typical_position' => 'top'],
            ['name' => 'Mint',           'family' => 'earthy',  'typical_position' => 'top'],
            ['name' => 'Basil',          'family' => 'earthy',  'typical_position' => 'top'],
            ['name' => 'Cucumber',       'family' => 'aquatic', 'typical_position' => 'top'],
            ['name' => 'Violet Leaf',    'family' => 'floral',  'typical_position' => 'top'],
            ['name' => 'Aldehydes',      'family' => 'musky',   'typical_position' => 'top'],
            ['name' => 'Sea Salt',       'family' => 'aquatic', 'typical_position' => 'top'],
            ['name' => 'Ozone',          'family' => 'aquatic', 'typical_position' => 'top'],
            ['name' => 'Eucalyptus',     'family' => 'earthy',  'typical_position' => 'top'],

            // Light spice top
            ['name' => 'Black Pepper',  'family' => 'spicy', 'typical_position' => 'top'],
            ['name' => 'Pink Pepper',   'family' => 'spicy', 'typical_position' => 'top'],
            ['name' => 'Ginger',        'family' => 'spicy', 'typical_position' => 'top'],
            ['name' => 'Cardamom',      'family' => 'spicy', 'typical_position' => 'top'],

            // Fruity top
            ['name' => 'Green Apple',    'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Peach',          'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Pear',           'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Raspberry',      'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Blackcurrant',   'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Melon',          'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Plum',           'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Lychee',         'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Mango',          'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Pineapple',      'family' => 'gourmand', 'typical_position' => 'top'],
            ['name' => 'Strawberry',     'family' => 'gourmand', 'typical_position' => 'top'],

            // ── HEART NOTES ────────────────────────────────────────────
            // Core florals
            ['name' => 'Rose',                 'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Jasmine',              'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Lavender',             'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Geranium',             'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Iris',                 'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Orris',                'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Ylang-Ylang',          'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Lily of the Valley',   'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Peony',                'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Violet',               'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Magnolia',             'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Freesia',              'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Tuberose',             'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Narcissus',            'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Gardenia',             'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Orange Blossom',       'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Cherry Blossom',       'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Heliotrope',           'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Mimosa',               'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Carnation',            'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Lotus',                'family' => 'floral', 'typical_position' => 'heart'],
            ['name' => 'Lily',                 'family' => 'floral', 'typical_position' => 'heart'],

            // Spice heart
            ['name' => 'Cinnamon',   'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Clove',      'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Nutmeg',     'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Saffron',    'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Cumin',      'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Bay Leaf',   'family' => 'spicy', 'typical_position' => 'heart'],
            ['name' => 'Incense',    'family' => 'resinous', 'typical_position' => 'heart'],

            // Herbal heart
            ['name' => 'Sage',      'family' => 'earthy', 'typical_position' => 'heart'],
            ['name' => 'Rosemary',  'family' => 'earthy', 'typical_position' => 'heart'],
            ['name' => 'Thyme',     'family' => 'earthy', 'typical_position' => 'heart'],
            ['name' => 'Tarragon',  'family' => 'earthy', 'typical_position' => 'heart'],
            ['name' => 'Juniper',   'family' => 'woody',  'typical_position' => 'heart'],

            // Aquatic heart
            ['name' => 'Water Lily',  'family' => 'aquatic', 'typical_position' => 'heart'],
            ['name' => 'Seaweed',     'family' => 'aquatic', 'typical_position' => 'heart'],
            ['name' => 'Marine',      'family' => 'aquatic', 'typical_position' => 'heart'],

            // ── BASE NOTES ─────────────────────────────────────────────
            // Woods
            ['name' => 'Sandalwood',      'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Cedarwood',       'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Vetiver',         'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Patchouli',       'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Oud',             'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Agarwood',        'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Guaiac Wood',     'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Rosewood',        'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Birch',           'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Oakmoss',         'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Driftwood',       'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Iso E Super',     'family' => 'woody', 'typical_position' => 'base'],
            ['name' => 'Cashmeran',       'family' => 'woody', 'typical_position' => 'base'],

            // Musks
            ['name' => 'Musk',            'family' => 'musky', 'typical_position' => 'base'],
            ['name' => 'White Musk',      'family' => 'musky', 'typical_position' => 'base'],
            ['name' => 'Clean Musk',      'family' => 'musky', 'typical_position' => 'base'],
            ['name' => 'Ambroxan',        'family' => 'musky', 'typical_position' => 'base'],
            ['name' => 'Civet',           'family' => 'musky', 'typical_position' => 'base'],
            ['name' => 'Castoreum',       'family' => 'musky', 'typical_position' => 'base'],

            // Resins & Orientals
            ['name' => 'Amber',           'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Benzoin',         'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Frankincense',    'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Myrrh',           'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Labdanum',        'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Styrax',          'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Elemi',           'family' => 'resinous', 'typical_position' => 'base'],
            ['name' => 'Opoponax',        'family' => 'resinous', 'typical_position' => 'base'],

            // Gourmand base
            ['name' => 'Vanilla',         'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Tonka Bean',      'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Coumarin',        'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Caramel',         'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Chocolate',       'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Coffee',          'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Coconut',         'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Almond',          'family' => 'gourmand', 'typical_position' => 'base'],
            ['name' => 'Praline',         'family' => 'gourmand', 'typical_position' => 'base'],

            // Animal / Smoke base
            ['name' => 'Ambergris',       'family' => 'musky',   'typical_position' => 'base'],
            ['name' => 'Leather',         'family' => 'woody',   'typical_position' => 'base'],
            ['name' => 'Smoke',           'family' => 'woody',   'typical_position' => 'base'],
            ['name' => 'Tobacco',         'family' => 'woody',   'typical_position' => 'base'],
            ['name' => 'Honey',           'family' => 'gourmand','typical_position' => 'base'],
            ['name' => 'Beeswax',         'family' => 'gourmand','typical_position' => 'base'],

            // Earthy base
            ['name' => 'Earth',           'family' => 'earthy',  'typical_position' => 'base'],
            ['name' => 'Moss',            'family' => 'earthy',  'typical_position' => 'base'],
            ['name' => 'Mushroom',        'family' => 'earthy',  'typical_position' => 'base'],
        ];

        foreach ($notes as $noteData) {
            Note::updateOrCreate(
                ['slug' => Str::slug($noteData['name'])],
                [
                    'name'             => $noteData['name'],
                    'slug'             => Str::slug($noteData['name']),
                    'family'           => $noteData['family'],
                    'typical_position' => $noteData['typical_position'],
                ]
            );
        }

        $this->command->info('Seeded ' . count($notes) . ' fragrance notes.');
    }
}
