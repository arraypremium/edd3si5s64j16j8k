<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Dashboard;
use App\Filament\Pages\Settings;
use App\Filament\Pages\Billing;
use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\Expenses\ExpenseResource;
use App\Filament\Resources\FollowUps\FollowUpResource;
use App\Filament\Resources\Invoices\InvoiceResource;
use App\Filament\Resources\Members\MemberResource;
use App\Filament\Resources\Plans\PlanResource;
use App\Filament\Resources\Services\ServiceResource;
use App\Filament\Resources\Subscriptions\SubscriptionResource;
use App\Http\Middleware\CheckGymStatus;
use App\Http\Middleware\SetAppLocale;
use App\Models\Gym;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationBuilder;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

/**
 * Filament panel provider for the gym tenant panel.
 */
class AdminPanelProvider extends PanelProvider
{
    /**
     * Configure the panel.
     */
    public function panel(Panel $panel): Panel
    {
        return $this->basePanel($panel)
            ->navigation(fn (NavigationBuilder $builder) => $this->buildNavigation($builder));
    }

    /**
     * Configure the base panel options.
     */
    public function basePanel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->passwordReset()
            ->brandName('Gymie Operations')
            ->unsavedChangesAlerts()
            ->colors($this->colors())
            ->darkMode(false)
            ->sidebarWidth('14rem')
            ->tenant(Gym::class, ownershipRelationship: 'gym', slugAttribute: 'url_slug')
            ->tenantMiddleware([
                CheckGymStatus::class,
            ], isPersistent: true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
                Settings::class,
                \App\Filament\Pages\Billing::class,
            ])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Profile Settings')
                    ->url(fn (): string => Settings::getUrl())
                    ->icon('heroicon-m-user-circle'),
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            /*
             * IMPORTANT:
             * Do NOT register FilamentShieldPlugin on the tenant /gym panel.
             *
             * Shield registers BezhanSalleh\FilamentShield\Resources\Roles\RoleResource.
             * That resource uses Spatie\Permission\Models\Role, which does not have a
             * gym() relationship. Since this panel is tenant-scoped with ownership
             * relationship "gym", Filament crashes with:
             *
             * "The model [Spatie\Permission\Models\Role] does not have a relationship named [gym]."
             *
             * Role management belongs in the /system panel only.
             */
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
            ->globalSearchKeyBindings(['command+k', 'ctrl+k']);
    }

    /**
     * Build grouped navigation for the tenant panel.
     */
    protected function buildNavigation(NavigationBuilder $builder): NavigationBuilder
    {
        $sales = [
            ...EnquiryResource::getNavigationItems(),
            ...FollowUpResource::getNavigationItems(),
        ];

        $billing = [
            ...InvoiceResource::getNavigationItems(),
            ...ExpenseResource::getNavigationItems(),
        ];

        $pro = [
            ...Billing::getNavigationItems(),
        ];

        $memberships = [
            ...MemberResource::getNavigationItems(),
            ...PlanResource::getNavigationItems(),
            ...ServiceResource::getNavigationItems(),
            ...SubscriptionResource::getNavigationItems(),
        ];

        $groups = [
            NavigationGroup::make(__('app.navigation.groups.sales'))
                ->items($sales)
                ->collapsed(false),

            NavigationGroup::make(__('app.navigation.groups.memberships'))
                ->items($memberships)
                ->collapsed(false),

            NavigationGroup::make(__('app.navigation.groups.billing'))
                ->items($billing)
                ->collapsed(false),

            NavigationGroup::make('Pro')
                ->items($pro)
                ->collapsed(false),
        ];

        return $builder
            ->groups($groups)
            ->item(
                NavigationItem::make(__('app.navigation.dashboard'))
                    ->icon('heroicon-o-chart-bar')
                    ->url(fn () => Dashboard::getUrl())
                    ->isActiveWhen(fn () => request()->routeIs('filament.admin.pages.dashboard'))
            );
    }

    /**
     * Panel color palette.
     *
     * @return array<string, mixed>
     */
    protected function colors(): array
    {
        return [
            'primary' => [
                50 => '#b3fefc',
                100 => '#37f2ee',
                200 => '#2dcdc9',
                300 => '#24adaa',
                400 => '#1c908d',
                500 => '#157573',
                600 => '#0e5c5a',
                700 => '#084543',
                800 => '#042f2e',
                900 => '#021f1e',
                950 => '#011413',
            ],
            'danger' => Color::Rose,
            'gray' => Color::Gray,
            'info' => Color::Blue,
            'success' => Color::Emerald,
            'warning' => Color::Orange,
        ];
    }
}
