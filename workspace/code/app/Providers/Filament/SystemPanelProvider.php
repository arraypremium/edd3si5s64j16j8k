<?php

namespace App\Providers\Filament;

use App\Filament\Resources\BusinessRoleResource;
use App\Filament\Resources\GymResource;
use App\Filament\Resources\GymSubscriptionResource;
use App\Filament\Resources\SystemAdminResource;
use App\Filament\Resources\SystemPlanResource;
use App\Filament\Resources\SystemRoleResource;
use App\Filament\Resources\Users\UserResource;
use App\Http\Middleware\SetAppLocale;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class SystemPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('system')
            ->path('system')
            ->authGuard('system_admin') // Uses our decoupled database-level system_admins table!
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->passwordReset()
            ->brandName('Gymie Business Hub')
            ->unsavedChangesAlerts()
            ->colors([
                'primary' => Color::Amber,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            ->darkMode(false)
            ->sidebarWidth('14rem')
            ->resources([
                GymResource::class,
                UserResource::class,
                GymSubscriptionResource::class,
                BusinessRoleResource::class,
                SystemPlanResource::class,
                SystemRoleResource::class,
                SystemAdminResource::class,
            ])
            ->pages([
                Dashboard::class,
            ])
            ->widgets([])
            ->plugins([
                FilamentShieldPlugin::make()
                    ->globallySearchable(false)
                    ->navigationIcon(fn (): null => null)
                    ->activeNavigationIcon(fn (): null => null),
            ])
            ->middleware([
                SetAppLocale::class,
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications()
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            // Train-stepper removed — sidebar navigation is the only navigation now.
            ->navigation(function (NavigationBuilder $builder) {
                return $builder
                    ->groups([
                        // Single "Business" group with all onboarding items as children.
                        // Matches the user's requested tree layout:
                        //   🏢 Business
                        //   ├── • Businesses
                        //   ├── • Users
                        //   ├── • Roles
                        //   ├── • System Plans
                        //   └── • Business Subscriptions
                        NavigationGroup::make('🏢 Business')
                        ->items([
                            ...GymResource::getNavigationItems(),
                            ...UserResource::getNavigationItems(),
                            ...GymSubscriptionResource::getNavigationItems(),
                            ...BusinessRoleResource::getNavigationItems(),
                            ...SystemPlanResource::getNavigationItems(),
                            ])
                            ->collapsed(false),

                        NavigationGroup::make('Administrator')
                            ->items([
                                ...SystemRoleResource::getNavigationItems(),
                                ...SystemAdminResource::getNavigationItems(),
                            ])
                            ->collapsed(false),
                    ])
                    ->item(
                        NavigationItem::make('System Dashboard')
                            ->icon('heroicon-o-cpu-chip')
                            ->url(fn () => Dashboard::getUrl())
                            ->isActiveWhen(fn () => request()->routeIs('filament.system.pages.dashboard'))
                    );
            })
            ->renderHook(
                PanelsRenderHook::GLOBAL_SEARCH_AFTER,
                fn (): HtmlString => new HtmlString(
                    Blade::render('@livewire(\\App\\Filament\\Livewire\\LocaleSwitcher::class, [], key(\'system-locale-switcher\'))')
                ),
            );
    }
}
