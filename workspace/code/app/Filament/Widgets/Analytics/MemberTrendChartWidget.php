<?php

namespace App\Filament\Widgets\Analytics;

use App\Services\Analytics\AnalyticsService;
use App\Support\Analytics\AnalyticsDateRange;
use App\Support\Dashboard\DashboardAccess;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;

class MemberTrendChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -34;

    protected ?string $maxHeight = '400px';

    public ?string $filter = null;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 4,
    ];

    protected function getType(): string
    {
        return 'line';
    }

    public function getHeading(): string|Htmlable|null
    {
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_TREND_CHART)
            ? 'Member Activity Trend'
            : DashboardAccess::lockedHeading('Member Activity Trend');
    }

    protected function getFilters(): ?array
    {
        return null;
    }

    private function resolveRange(): AnalyticsDateRange
    {
        return DashboardAccess::rangeFromPageFilters($this->pageFilters);
    }

    protected function getOptions(): array|RawJs|null
    {
        return RawJs::make(<<<JS
{
    interaction: { mode: 'index', intersect: false },
    scales: {
        x: { ticks: { maxRotation: 0 }, grid: { display: false } },
        y: { beginAtZero: true, ticks: { precision: 0 } }
    },
    plugins: {
        legend: {
            position: 'bottom',
            align: 'center',
        }
    }
}
JS);
    }

    protected function getData(): array
    {
        $range = $this->resolveRange();
        $period = is_array($this->pageFilters ?? null) && is_string($this->pageFilters['period'] ?? null)
            ? $this->pageFilters['period']
            : '30days';

        $useDaily = in_array($period, ['7days', '30days', 'month'], true)
            || ($range->start->diffInDays($range->end) <= 62);

        $service = app(AnalyticsService::class);

        $newMembers = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_TREND_CHART)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_NEW_MEMBERS)
            ? ($useDaily ? $service->newMemberTrendByDate($range) : $service->newMemberTrendByMonth($range))
            : [];

        $renewals = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_TREND_CHART)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_RENEWALS)
            ? ($useDaily ? $service->renewalTrendByDate($range) : $service->renewalTrendByMonth($range))
            : [];

        $expired = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_TREND_CHART)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPIRED_MEMBERS)
            ? ($useDaily ? $service->expiredTrendByDate($range) : $service->expiredTrendByMonth($range))
            : [];

        $labels = [];
        $newSeries = [];
        $renewalSeries = [];
        $expiredSeries = [];

        if ($useDaily) {
            $period = CarbonPeriod::create($range->start->toDateString(), $range->end->toDateString());

            foreach ($period as $date) {
                if (! $date instanceof CarbonInterface) {
                    continue;
                }

                $dayKey = $date->toDateString();
                $labels[] = CarbonImmutable::parse($date)->translatedFormat('j M Y');
                $newSeries[] = (float) ($newMembers[$dayKey] ?? 0);
                $renewalSeries[] = (float) ($renewals[$dayKey] ?? 0);
                $expiredSeries[] = (float) ($expired[$dayKey] ?? 0);
            }
        } else {
            $start = $range->start->startOfMonth();
            $end = $range->end->startOfMonth();

            $period = CarbonPeriod::create($start, '1 month', $end);
            foreach ($period as $date) {
                if (! $date instanceof CarbonInterface) {
                    continue;
                }

                $monthKey = $date->format('Y-m');
                $labels[] = CarbonImmutable::parse($date)->translatedFormat('M Y');
                $newSeries[] = (float) ($newMembers[$monthKey] ?? 0);
                $renewalSeries[] = (float) ($renewals[$monthKey] ?? 0);
                $expiredSeries[] = (float) ($expired[$monthKey] ?? 0);
            }
        }

        return [
            'datasets' => [
                [
                    'label' => __('app.widgets.new_members'),
                    'data' => $newSeries,
                    'borderColor' => '#14b8a6',
                    'backgroundColor' => 'rgba(20, 184, 166, 0.08)',
                    'tension' => 0.35,
                    'fill' => true,
                    'borderWidth' => 2,
                ],
                [
                    'label' => __('app.widgets.renewals'),
                    'data' => $renewalSeries,
                    'borderColor' => '#3b82f6',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.08)',
                    'tension' => 0.35,
                    'fill' => true,
                    'borderWidth' => 2,
                ],
                [
                    'label' => __('app.widgets.expired_not_renewed'),
                    'data' => $expiredSeries,
                    'borderColor' => '#ef4444',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.08)',
                    'tension' => 0.35,
                    'fill' => true,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
