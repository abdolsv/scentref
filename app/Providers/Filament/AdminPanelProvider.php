<?php

namespace App\Providers\Filament;

use App\Filament\Widgets\CatalogOverviewChart;
use App\Filament\Widgets\DatabaseStatsWidget;
use App\Filament\Widgets\LatestPriceAlertsWidget;
use App\Filament\Widgets\QuickActionsWidget;
use App\Filament\Widgets\VendorAuditQueueWidget;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery; // Replaces VerifyCsrfToken in v4
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::hex('#C9A84C'), // ScentRef Gold branding
                'gray'    => Color::Zinc,
                'danger'  => Color::Rose,
                'info'    => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->brandName('ScentRef Admin')
            ->brandLogo(null)
            ->favicon(asset('favicon.ico'))
            
            // Automatic structural discoveries
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            
            // Layout Dashboard Widgets
            ->widgets([
                DatabaseStatsWidget::class,
                QuickActionsWidget::class,
                CatalogOverviewChart::class,
                LatestPriceAlertsWidget::class,
                VendorAuditQueueWidget::class,
            ])
            
            // Filament v4 Unified Middleware Architecture
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            
            // Filament v4 Object-Driven Sidebar Groupings
            ->navigationGroups([
                NavigationGroup::make()
                    ->label('Perfume Database')
                    ->icon('heroicon-o-square-3-stack-3d'),
                
                NavigationGroup::make()
                    ->label('Content')
                    ->icon('heroicon-o-document-text'),
                
                NavigationGroup::make()
                    ->label('Pricing')
                    ->icon('heroicon-o-banknotes'),
                
                NavigationGroup::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth'),
            ])
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth('full');
    }
}
