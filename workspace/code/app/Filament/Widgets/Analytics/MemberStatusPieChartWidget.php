<?php

namespace App\Filament\Widgets\Analytics;

use App\Services\Analytics\AnalyticsService;
use App\Support\Dashboard\DashboardAccess;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;

class MemberStatusPieChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -37;

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
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_STATUS_CHART)
            ? 'Member Status Breakdown'
            : DashboardAccess::lockedHeading('Member Status Overview');
    }

    protected function getFilters(): ?array
    {
        return null;
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
                    return label + ': ' + Number(value).toLocaleString() + ' members';
                }
            }
        }
    }
}
JS);
    }

    protected function getData(): array
    {
        $labels = [
            __('app.widgets.active_members'),
            __('app.widgets.new_members'),
            __('app.widgets.renewals'),
            __('app.widgets.expired_not_renewed'),
        ];

        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_STATUS_CHART)) {
            return [
                'datasets' => [[
                    'data' => [0, 0, 0, 0],
                    'backgroundColor' => ['#cbd5e1', '#e2e8f0', '#94a3b8', '#64748b'],
                ]],
                'labels' => $labels,
            ];
        }

        $metrics = app(AnalyticsService::class)->membershipMetrics(DashboardAccess::rangeFromPageFilters($this->pageFilters));

        return [
            'datasets' => [[
                'data' => [
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_ACTIVE_MEMBERS) ? (int) $metrics['active_members'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_NEW_MEMBERS) ? (int) $metrics['new_signups'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_RENEWALS) ? (int) $metrics['renewals'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPIRED_MEMBERS) ? (int) $metrics['expired_not_renewed'] : 0,
                ],
                'backgroundColor' => ['#0f766e', '#2563eb', '#d97706', '#e11d48'],
                'hoverOffset' => 6,
                'borderWidth' => 2,
                'borderColor' => '#ffffff',
            ]],
            'labels' => $labels,
        ];
    }
}
