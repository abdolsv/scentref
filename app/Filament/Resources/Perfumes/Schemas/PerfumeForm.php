<?php

namespace App\Filament\Resources\Perfumes\Schemas;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

class PerfumeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make()->tabs([

                // TAB 1: IDENTITY
                Tab::make("Identity")->schema([
                    TextInput::make("name")
                        ->required()
                        ->columnSpanFull(),
                    
                    TextInput::make("slug")
                        ->required()
                        ->unique(ignoreRecord: true),
                    
                    Select::make("brand_id")
                        ->relationship("brand", "name")
                        ->searchable()
                        ->preload()
                        ->required(),
                    
                    Select::make("scent_family_id")
                        ->relationship("scentFamily", "name")
                        ->searchable()
                        ->preload(),
                    
                    Select::make("gender_target")
                        ->options([
                            "men" => "Men",
                            "women" => "Women",
                            "unisex" => "Unisex"
                        ])
                        ->required()
                        ->in(['men', 'women', 'unisex']),
                    
                    Select::make("concentration")
                        ->options([
                            "parfum" => "Parfum",
                            "edp" => "EDP",
                            "edt" => "EDT",
                            "edc" => "EDC",
                            "body_spray" => "Body Spray",
                            "oil" => "Oil"
                        ])
                        ->required()
                        ->in(['parfum', 'edp', 'edt', 'edc', 'body_spray', 'oil']),
                    
                    TextInput::make("year_released")
                        ->numeric()
                        ->minValue(1900)
                        ->maxValue(2030),
                    
                    TextInput::make("perfumer"),
                    
                    TextInput::make("collection_line"),
                    
                    Textarea::make("official_description")
                        ->rows(3)
                        ->columnSpanFull(),
                ])->columns(2),

                // TAB 2: OLFACTORY
                Tab::make("Olfactory")->schema([
                    Select::make("topNotes")
                        ->relationship("topNotes", "name")
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                    
                    Select::make("heartNotes")
                        ->relationship("heartNotes", "name")
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                    
                    Select::make("baseNotes")
                        ->relationship("baseNotes", "name")
                        ->multiple()
                        ->searchable()
                        ->preload()
                        ->columnSpanFull(),
                    
                    Textarea::make("opening_character")
                        ->rows(2),
                    
                    Textarea::make("drydown_character")
                        ->rows(2),
                    
                    Textarea::make("longevity_notes")
                        ->rows(2)
                        ->columnSpanFull(),
                ])->columns(2),

                // TAB 3: PERFORMANCE
                Tab::make("Performance")->schema([
                    TextInput::make("longevity_heat")
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10)
                        ->helperText("1-10 in Lagos outdoor heat"),
                    
                    TextInput::make("longevity_ac")
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10)
                        ->helperText("1-10 in AC office"),
                    
                    TextInput::make("longevity_hours_avg")
                        ->numeric()
                        ->step(0.5),
                    
                    TextInput::make("sillage_rating")
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10),
                    
                    Select::make("projection")
                        ->options([
                            "skin_scent" => "Skin Scent",
                            "soft" => "Soft",
                            "moderate" => "Moderate",
                            "strong" => "Strong",
                            "beast_mode" => "Beast Mode"
                        ]),
                    
                    CheckboxList::make("best_season_nigeria")
                        ->options([
                            "harmattan" => "Harmattan",
                            "rainy" => "Rainy Season",
                            "hot" => "Hot Season",
                            "all" => "All Year"
                        ]),
                    
                    CheckboxList::make("best_occasion")
                        ->options([
                            "office" => "Office/Work",
                            "date_night" => "Date Night",
                            "church" => "Church/Mosque",
                            "outdoor" => "Outdoors",
                            "night_out" => "Night Out",
                            "casual" => "Casual Daily"
                        ]),
                ])->columns(2),

                // TAB 4: MARKET DATA
                Tab::make("Market Data")->schema([
                    Select::make("availability")
                        ->options([
                            "available" => "Available in Nigeria",
                            "import_only" => "Import Only",
                            "not_available" => "Not Available",
                        ])
                        ->required()
                        ->default('available'),
                    
                    TextInput::make("avg_price_ngn")
                        ->numeric()
                        ->prefix("₦")
                        ->helperText("Auto-calculated. Override only if needed."),
                    
                    CheckboxList::make("physical_store_cities")
                        ->options([
                            "lagos" => "Lagos",
                            "abuja" => "Abuja",
                            "ph" => "Port Harcourt",
                            "kano" => "Kano",
                            "ibadan" => "Ibadan"
                        ]),
                    
                    Select::make("import_difficulty")
                        ->options([
                            "easy" => "Easy",
                            "moderate" => "Moderate",
                            "hard" => "Hard",
                            "import_only" => "Import Only"
                        ]),
                    
                    DatePicker::make("last_price_updated"),
                ])->columns(2),

                // TAB 5: EDITORIAL
                Tab::make("Editorial")->schema([
                    RichEditor::make("review_summary")
                        ->toolbarButtons(["bold", "italic", "bulletList", "h3"])
                        ->columnSpanFull(),
                    
                    TextInput::make("pw_rating")
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(10),
                    
                    Select::make("our_verdict")
                        ->options([
                            "must_buy" => "Must Buy",
                            "highly_recommended" => "Highly Recommended",
                            "recommended" => "Recommended",
                            "worth_trying" => "Worth Trying",
                            "skip" => "Skip It"
                        ]),
                    
                    Textarea::make("who_should_buy")
                        ->rows(2),
                    
                    Textarea::make("who_should_avoid")
                        ->rows(2),
                    
                    RichEditor::make("authenticity_tips")
                        ->columnSpanFull()
                        ->toolbarButtons(["bold", "italic", "bulletList"]),
                ])->columns(2),

                // TAB 6: MEDIA & SEO
                Tab::make("Media & SEO")->schema([
                    FileUpload::make("bottle_image_path")
                        ->image()
                        ->disk("s3")
                        ->directory("perfumes/bottles")
                        ->imageResizeTargetWidth(400)
                        ->imageResizeTargetHeight(400),
                    
                    FileUpload::make("box_image_path")
                        ->image()
                        ->disk("s3")
                        ->directory("perfumes/boxes"),
                    
                    TextInput::make("meta_title")
                        ->helperText("Auto-generated if empty")
                        ->columnSpanFull(),
                    
                    Textarea::make("meta_description")
                        ->rows(2)
                        ->columnSpanFull()
                        ->helperText("Auto-generated if empty"),
                    
                    TextInput::make("official_website_url")
                        ->url(),
                    
                    TextInput::make("fragrantica_url")
                        ->url(),
                    
                    Toggle::make("is_complete")
                        ->helperText("All fields filled?")
                        ->required(),
                    
                    Toggle::make("is_published")
                        ->required(),
                    
                    DateTimePicker::make('published_at'),
                ])->columns(2),

            ])->columnSpanFull()
        ]);
    }
}
