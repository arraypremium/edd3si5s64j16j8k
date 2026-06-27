<?php

namespace App\Filament\Widgets\Analytics;

use App\Helpers\Helpers;
use App\Services\Analytics\AnalyticsService;
use App\Support\Dashboard\DashboardAccess;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;

class FinancialSummaryPieChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -36;

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
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_FINANCIAL_SUMMARY_CHART)
            ? 'Financial Performance Breakdown'
            : DashboardAccess::lockedHeading('Financial Summary');
    }

    protected function getFilters(): ?array
    {
        return null;
    }

    protected function getOptions(): array|RawJs|null
    {
        $currencySymbol = Helpers::getCurrencySymbol();
        $currencySymbol = str_replace("'", "\\'", $currencySymbol);

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
                    return label + ': ' + '{$currencySymbol}' + Number(value).toLocaleString();
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
            __('app.widgets.profit'),
            'Loss Sufferage',
            __('app.widgets.total_expense'),
            __('app.widgets.outstanding_payments'),
            __('app.widgets.net_revenue'),
        ];

        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_FINANCIAL_SUMMARY_CHART)) {
            return [
                'datasets' => [[
                    'data' => [0, 0, 0, 0, 0],
                    'backgroundColor' => ['#10b981', '#f97316', '#ef4444', '#6366f1', '#14b8a6'],
                ]],
                'labels' => $labels,
            ];
        }

        $metrics = app(AnalyticsService::class)->financialMetrics(DashboardAccess::rangeFromPageFilters($this->pageFilters));
        $loss = max((float) $metrics['expenses'] - (float) $metrics['collected'], 0);

        return [
            'datasets' => [[
                'data' => [
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_PROFIT) ? (float) $metrics['profit'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_LOSS) ? $loss : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPENSES) ? (float) $metrics['expenses'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_PENDING_PAYMENTS) ? (float) $metrics['outstanding'] : 0,
                    DashboardAccess::allowsMetric(DashboardAccess::METRIC_NET_REVENUE) ? (float) $metrics['net_revenue'] : 0,
                ],
                'backgroundColor' => ['#059669', '#7c3aed', '#f43f5e', '#0284c7', '#475569'],
                'hoverOffset' => 6,
                'borderWidth' => 2,
                'borderColor' => '#ffffff',
            ]],
            'labels' => $labels,
        ];
    }
}
