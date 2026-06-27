<?php

namespace App\Filament\Widgets\Analytics;

use App\Models\Member;
use App\Support\Analytics\AnalyticsDateRange;
use App\Support\Dashboard\DashboardAccess;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Str;

class MemberSourceChartWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -33;

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
        return DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_SOURCE_CHART)
            ? 'Member Acquisition Source'
            : DashboardAccess::lockedHeading('Member Source');
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
        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBER_SOURCE_CHART)) {
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

        $rows = Member::query()
            ->whereBetween('created_at', [$range->start, $range->end])
            ->whereNotNull('source')
            ->where('source', '!=', '')
            ->selectRaw('source, count(*) as total')
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        if ($rows->isEmpty()) {
            return [
                'datasets' => [[
                    'data' => [1],
                    'backgroundColor' => ['#e2e8f0'],
                    'borderWidth' => 0,
                ]],
                'labels' => ['No source data in period'],
            ];
        }

        $labels = $rows->map(fn ($row): string => match ($row->source) {
            'word_of_mouth' => __('app.options.source.word_of_mouth') ?? 'Word of mouth',
            'google_business_account' => __('app.options.source.google_business_account') ?? 'Google business account',
            'website' => __('app.options.source.website') ?? 'Website',
            'instagram' => __('app.options.source.instagram') ?? 'Instagram',
            'facebook' => __('app.options.source.facebook') ?? 'Facebook',
            'whatsapp' => __('app.options.source.whatsapp') ?? 'WhatsApp',
            'justdial' => __('app.options.source.justdial') ?? 'Justdial',
            'referral' => __('app.options.source.referral') ?? 'Referral',
            'other' => __('app.options.source.other') ?? 'Other',
            default => Str::headline((string) $row->source),
        })->all();

        $data = $rows->pluck('total')->map(fn ($val) => (int) $val)->all();

        return [
            'datasets' => [[
                'data' => $data,
                'backgroundColor' => ['#84cc16', '#a855f7', '#ec4899', '#f97316', '#06b6d4', '#eab308', '#22c55e', '#3b82f6', '#64748b'],
                'hoverOffset' => 6,
                'borderWidth' => 2,
                'borderColor' => '#ffffff',
            ]],
            'labels' => $labels,
        ];
    }
}
