<?php

namespace App\Filament\Widgets\Analytics;

use App\Services\Analytics\AnalyticsService;
use App\Support\Analytics\AnalyticsDateRange;
use App\Support\Dashboard\DashboardAccess;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * Membership insights widget.
 */
class MembershipMetricsWidget extends StatsOverviewWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -41;

    protected int|string|array $columnSpan = 'full';

    /**
     * @var int | array<string, ?int> | null
     */
    protected int|array|null $columns = 4;

    /**
     * Build an inline delta label for KPI cards.
     *
     * @return array{label: string, icon: string|null, class: string}
     */
    private function deltaInline(int $current, int $previous): array
    {
        if ($previous <= 0) {
            if ($current <= 0) {
                return [
                    'label' => '0%',
                    'icon' => 'heroicon-o-minus',
                    'class' => 'text-gray-500',
                ];
            }

            return [
                'label' => "+{$current}",
                'icon' => 'heroicon-o-arrow-trending-up',
                'class' => 'text-success-600 dark:text-success-400',
            ];
        }

        $pct = (($current - $previous) / $previous) * 100;
        $pct = round($pct, 1);

        if ($pct === 0.0) {
            return [
                'label' => '0%',
                'icon' => 'heroicon-o-minus',
                'class' => 'text-gray-500',
            ];
        }

        if ($pct > 0) {
            return [
                'label' => "+{$pct}%",
                'icon' => 'heroicon-o-arrow-trending-up',
                'class' => 'text-success-600 dark:text-success-400',
            ];
        }

        $pct = abs($pct);

        return [
            'label' => "-{$pct}%",
            'icon' => 'heroicon-o-arrow-trending-down',
            'class' => 'text-danger-600 dark:text-danger-400',
        ];
    }

    /**
     * Render a KPI value with an inline delta.
     *
     * @param  array{label: string, icon: string|null, class: string}  $delta
     */
    private function valueWithDelta(string $value, array $delta): HtmlString
    {
        $value = e($value);
        $deltaLabel = e($delta['label']);
        $deltaClass = e($delta['class']);

        $deltaIcon = null;
        if (filled($delta['icon'])) {
            $deltaIcon = Blade::render(
                '<x-filament::icon :icon="$icon" class="h-4 w-4 text-current" />',
                ['icon' => $delta['icon']],
            );
        }

        return new HtmlString(<<<HTML
<div class="flex items-baseline gap-2 my-1">
    <span>{$value}</span>
    <span class="text-sm font-semibold {$deltaClass} inline-flex items-center gap-1">{$deltaLabel}{$deltaIcon}</span>
</div>
HTML);
    }

    private function lockedValue(): HtmlString
    {
        $icon = Blade::render('<x-filament::icon icon="heroicon-m-lock-closed" class="h-4 w-4 text-warning-500 inline-block" />');

        return new HtmlString('<div class="flex items-center gap-2 my-1"><span>0</span>' . $icon . '</div>');
    }

    /**
     * Tailwind selector classes that color the main stat icon using the panel primary color.
     */
    private function primaryStatIconClasses(): string
    {
        return '[&_.fi-wi-stats-overview-stat-label-ctn>.fi-icon]:text-primary-400 dark:[&_.fi-wi-stats-overview-stat-label-ctn>.fi-icon]:text-primary-400';
    }

    private function lockedStat(string $label, string $icon): Stat
    {
        return Stat::make($label, $this->lockedValue())
            ->icon($icon)
            ->extraAttributes(['class' => $this->primaryStatIconClasses()])
            ->description(DashboardAccess::lockedMessage())
            ->descriptionColor('warning');
    }

    /**
     * @return array<int, Stat>
     */
    protected function getStats(): array
    {
        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBERSHIP_KPIS)) {
            return [
                $this->lockedStat(__('app.widgets.active_members'), 'heroicon-o-user-group'),
                $this->lockedStat(__('app.widgets.new_members'), 'heroicon-o-user-plus'),
                $this->lockedStat(__('app.widgets.renewals'), 'heroicon-o-arrow-path'),
                $this->lockedStat(__('app.widgets.expired_not_renewed'), 'heroicon-o-x-circle'),
            ];
        }

        $range = DashboardAccess::rangeFromPageFilters($this->pageFilters);
        $service = app(AnalyticsService::class);
        $metrics = $service->membershipMetrics($range);

        $days = $range->end->diffInDays($range->start) + 1;
        $previousRange = new AnalyticsDateRange(
            $range->start->subDays($days),
            $range->end->subDays($days),
        );
        $previous = $service->membershipMetrics($previousRange);

        $activeAllowed = DashboardAccess::allowsMetric(DashboardAccess::METRIC_ACTIVE_MEMBERS);
        $newAllowed = DashboardAccess::allowsMetric(DashboardAccess::METRIC_NEW_MEMBERS);
        $renewalAllowed = DashboardAccess::allowsMetric(DashboardAccess::METRIC_RENEWALS);
        $expiredAllowed = DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPIRED_MEMBERS);

        $activeDelta = $this->deltaInline($metrics['active_members'], $previous['active_members']);
        $signupDelta = $this->deltaInline($metrics['new_signups'], $previous['new_signups']);
        $renewalDelta = $this->deltaInline($metrics['renewals'], $previous['renewals']);
        $expiredDelta = $this->deltaInline($metrics['expired_not_renewed'], $previous['expired_not_renewed']);

        return [
            Stat::make(
                __('app.widgets.active_members'),
                $activeAllowed ? $this->valueWithDelta((string) $metrics['active_members'], $activeDelta) : $this->lockedValue(),
            )
                ->icon('heroicon-o-user-group')
                ->extraAttributes(['class' => $this->primaryStatIconClasses()])
                ->description($activeAllowed
                    ? __('app.widgets.vs_previous_period', ['count' => (string) $previous['active_members']])
                    : DashboardAccess::lockedMessage())
                ->descriptionColor($activeAllowed ? 'gray' : 'warning'),
            Stat::make(
                __('app.widgets.new_members'),
                $newAllowed ? $this->valueWithDelta((string) $metrics['new_signups'], $signupDelta) : $this->lockedValue(),
            )
                ->icon('heroicon-o-user-plus')
                ->extraAttributes(['class' => $this->primaryStatIconClasses()])
                ->description($newAllowed
                    ? __('app.widgets.vs_previous_period', ['count' => (string) $previous['new_signups']])
                    : DashboardAccess::lockedMessage())
                ->descriptionColor($newAllowed ? 'gray' : 'warning'),
            Stat::make(
                __('app.widgets.renewals'),
                $renewalAllowed ? $this->valueWithDelta((string) $metrics['renewals'], $renewalDelta) : $this->lockedValue(),
            )
                ->icon('heroicon-o-arrow-path')
                ->extraAttributes(['class' => $this->primaryStatIconClasses()])
                ->description($renewalAllowed
                    ? __('app.widgets.vs_previous_period', ['count' => (string) $previous['renewals']])
                    : DashboardAccess::lockedMessage())
                ->descriptionColor($renewalAllowed ? 'gray' : 'warning'),
            Stat::make(
                __('app.widgets.expired_not_renewed'),
                $expiredAllowed ? $this->valueWithDelta((string) $metrics['expired_not_renewed'], $expiredDelta) : $this->lockedValue(),
            )
                ->icon('heroicon-o-x-circle')
                ->extraAttributes(['class' => $this->primaryStatIconClasses()])
                ->description($expiredAllowed
                    ? __('app.widgets.vs_previous_period', ['count' => (string) $previous['expired_not_renewed']])
                    : DashboardAccess::lockedMessage())
                ->descriptionColor($expiredAllowed ? 'gray' : 'warning'),
        ];
    }
}
