<?php

namespace App\Filament\Pages;

use App\Models\SystemPlan;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use BackedEnum;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Billing extends Page
{
    protected static ?string $title = 'Pro';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-sparkles';

    protected string $view = 'filament.pages.billing';

    protected static bool $shouldRegisterNavigation = true;

    public static function getNavigationLabel(): string
    {
        return 'Pro';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pro';
    }

    public function getTitle(): string
    {
        return 'Pro';
    }

    public function getHeading(): string | Htmlable
    {
        return new HtmlString('<span class="inline-flex items-center gap-2.5"><x-filament::icon icon="heroicon-o-sparkles" class="h-8 w-8 text-primary-500 inline-block" /><span>Pro</span></span>');
    }

    public function getHeaderData(): array
    {
        $tenant = Filament::getTenant();

        return [
            'status' => $tenant->subscription_status ?? 'none',
            'expiry_date' => $tenant->expiry_date?->format('d M, Y'),
            'plan_name' => $tenant->systemPlan?->name ?? 'No Plan',
        ];
    }

    public function getPlansProperty()
    {
        return SystemPlan::active()->get();
    }
}
