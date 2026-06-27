<?php

namespace App\Filament\Widgets\Analytics;

use App\Models\Subscription;
use App\Support\Analytics\AnalyticsDateRange;
use App\Support\Dashboard\DashboardAccess;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;

class TopPlansChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -31;

    protected ?string $maxHeight = '380px';

    public ?string $filter = null;

    /**
     * @var int | string | array<string, int | null>
     */
    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 1,
    ];

    protected function getType(): string
    {
        return 'pie';
    }

    public function getHeading(): string|Htmlable|null
    {
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_TOP_PLANS_CHART)
            ? 'Most Used Plans'
            : DashboardAccess::lockedHeading('Most Used Plans');
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
    responsive: true,
    maintainAspectRatio: false,
    layout: { padding: 10 },
    plugins: {
        legend: {
            position: 'bottom',
            labels: { boxWidth: 10, padding: 14, font: { weight: '600', size: 11 } }
        },
        tooltip: {
            padding: 12,
            boxPadding: 6,
            callbacks: {
                label: (context) => {
                    const label = context.label || '';
                    const value = context.parsed || 0;
                    return label + ': ' + Number(value).toLocaleString() + ' subscriptions';
                }
            }
        }
    }
}
JS);
    }

    protected function getData(): array
    {
        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_TOP_PLANS_CHART)) {
            return [
                'datasets' => [[
                    'data' => [1],
                    'backgroundColor' => ['#cbd5e1'],
                    'borderWidth' => 0,
                ]],
                'labels' => ['Locked'],
            ];
        }

        $range = $this->resolveRange();

        $rows = Subscription::query()
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->whereBetween('subscriptions.created_at', [$range->start, $range->end])
            ->selectRaw('plans.name as plan_name, count(subscriptions.id) as total')
            ->groupBy('plans.name', 'plans.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        if ($rows->isEmpty()) {
            return [
                'datasets' => [[
                    'data' => [1],
                    'backgroundColor' => ['#e2e8f0'],
                    'borderWidth' => 0,
                ]],
                'labels' => ['No subscriptions in period'],
            ];
        }

        return [
            'datasets' => [[
                'data' => $rows->pluck('total')->map(fn ($val) => (int) $val)->all(),
                'backgroundColor' => ['#6366f1', '#ec4899', '#f59e0b', '#10b981', '#0ea5e9'],
                'hoverOffset' => 6,
                'borderWidth' => 2,
                'borderColor' => '#ffffff',
            ]],
            'labels' => $rows->pluck('plan_name')->all(),
        ];
    }
}
