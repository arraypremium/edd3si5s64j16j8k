<?php

namespace App\Filament\Widgets\Analytics;

use App\Models\Subscription;
use App\Support\Analytics\AnalyticsDateRange;
use App\Support\Dashboard\DashboardAccess;
use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Carbon\CarbonPeriod;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;

class TopServicesChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -32;

    protected ?string $maxHeight = '360px';

    public ?string $filter = null;

    /**
     * @var int | string | array<string, int | null>
     */
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
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_TOP_SERVICES_CHART)
            ? 'Most Used Services Trend'
            : DashboardAccess::lockedHeading('Most Used Services');
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
    interaction: { mode: 'index', intersect: false },
    scales: {
        x: { ticks: { maxRotation: 0 }, grid: { display: false } },
        y: { beginAtZero: true, ticks: { precision: 0 } }
    },
    plugins: {
        legend: { position: 'bottom', labels: { boxWidth: 10, padding: 14, font: { weight: '600' } } }
    }
}
JS);
    }

    protected function getData(): array
    {
        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_TOP_SERVICES_CHART)) {
            return [
                'datasets' => [[
                    'label' => 'Locked',
                    'data' => [0],
                    'borderColor' => '#cbd5e1',
                ]],
                'labels' => ['Locked'],
            ];
        }

        $range = $this->resolveRange();
        $periodKey = is_array($this->pageFilters ?? null) && is_string($this->pageFilters['period'] ?? null)
            ? $this->pageFilters['period']
            : '30days';

        $useDaily = in_array($periodKey, ['7days', '30days', 'month'], true)
            || ($range->start->diffInDays($range->end) <= 62);

        $topServices = Subscription::query()
            ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
            ->join('services', 'plans.service_id', '=', 'services.id')
            ->whereBetween('subscriptions.created_at', [$range->start, $range->end])
            ->selectRaw('services.id, services.name, count(subscriptions.id) as total')
            ->groupBy('services.id', 'services.name')
            ->orderByDesc('total')
            ->limit(3)
            ->get();

        if ($topServices->isEmpty()) {
            return [
                'datasets' => [[
                    'label' => 'No activity recorded',
                    'data' => [0],
                    'borderColor' => '#94a3b8',
                ]],
                'labels' => ['No data'],
            ];
        }

        $labels = [];
        $buckets = [];

        if ($useDaily) {
            $period = CarbonPeriod::create($range->start->toDateString(), $range->end->toDateString());
            foreach ($period as $date) {
                if (! $date instanceof CarbonInterface) {
                    continue;
                }
                $key = $date->toDateString();
                $labels[] = CarbonImmutable::parse($date)->translatedFormat('j M');
                $buckets[$key] = [];
            }

            $rows = Subscription::query()
                ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                ->whereIn('plans.service_id', $topServices->pluck('id'))
                ->whereBetween('subscriptions.created_at', [$range->start, $range->end])
                ->selectRaw('plans.service_id, DATE(subscriptions.created_at) as dt, count(*) as cnt')
                ->groupBy('plans.service_id', 'dt')
                ->get();

            foreach ($rows as $row) {
                $buckets[(string) $row->dt][(int) $row->service_id] = (int) $row->cnt;
            }
        } else {
            $start = $range->start->startOfMonth();
            $end = $range->end->startOfMonth();
            $period = CarbonPeriod::create($start, '1 month', $end);
            foreach ($period as $date) {
                if (! $date instanceof CarbonInterface) {
                    continue;
                }
                $key = $date->format('Y-m');
                $labels[] = CarbonImmutable::parse($date)->translatedFormat('M Y');
                $buckets[$key] = [];
            }

            $rows = Subscription::query()
                ->join('plans', 'subscriptions.plan_id', '=', 'plans.id')
                ->whereIn('plans.service_id', $topServices->pluck('id'))
                ->whereBetween('subscriptions.created_at', [$range->start, $range->end])
                ->selectRaw('plans.service_id, DATE_FORMAT(subscriptions.created_at, "%Y-%m") as ym, count(*) as cnt')
                ->groupBy('plans.service_id', 'ym')
                ->get();

            foreach ($rows as $row) {
                $buckets[(string) $row->ym][(int) $row->service_id] = (int) $row->cnt;
            }
        }

        $colors = [
            ['border' => '#06b6d4', 'bg' => 'rgba(6, 182, 212, 0.08)'],
            ['border' => '#3b82f6', 'bg' => 'rgba(59, 130, 246, 0.08)'],
            ['border' => '#8b5cf6', 'bg' => 'rgba(139, 92, 246, 0.08)'],
        ];

        $datasets = [];
        foreach ($topServices->values() as $idx => $svc) {
            $series = [];
            foreach ($buckets as $timeKey => $svcMap) {
                $series[] = $svcMap[(int) $svc->id] ?? 0;
            }

            $col = $colors[$idx] ?? $colors[0];
            $datasets[] = [
                'label' => $svc->name,
                'data' => $series,
                'borderColor' => $col['border'],
                'backgroundColor' => $col['bg'],
                'tension' => 0.35,
                'fill' => true,
                'borderWidth' => 2,
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $labels,
        ];
    }
}
