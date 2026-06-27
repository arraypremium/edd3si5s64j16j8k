<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\Analytics\CashflowTrendChartWidget;
use App\Filament\Widgets\Analytics\ExpenseCategoriesDoughnutChartWidget;
use App\Filament\Widgets\Analytics\FinancialMetricsWidget;
use App\Filament\Widgets\Analytics\FinancialSummaryPieChartWidget;
use App\Filament\Widgets\Analytics\MemberSourceChartWidget;
use App\Filament\Widgets\Analytics\MembershipMetricsWidget;
use App\Filament\Widgets\Analytics\MembershipOverviewSubscriptionsTableWidget;
use App\Filament\Widgets\Analytics\MemberStatusPieChartWidget;
use App\Filament\Widgets\Analytics\MemberTrendChartWidget;
use App\Filament\Widgets\Analytics\RecentTransactionsTableWidget;
use App\Filament\Widgets\Analytics\TopPlansChartWidget;
use App\Filament\Widgets\Analytics\TopServicesChartWidget;
use App\Support\Dashboard\DashboardAccess;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard\Concerns\HasFilters;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;

/**
 * Main application dashboard.
 */
class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFilters;

    protected static string $routePath = 'dashboard';

    protected static ?string $title = null;

    public ?array $filters = null;

    /**
     * Suppress Livewire URL query string pushes for filters state.
     *
     * @return array<string, mixed>
     */
    protected function queryString(): array
    {
        return [];
    }

    public function getTitle(): string
    {
        return __('app.dashboard.title');
    }

    public static function getNavigationLabel(): string
    {
        return __('app.navigation.dashboard');
    }

    public function getHeader(): ?View
    {
        return view('filament.pages.dashboard-header');
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->inline()
            ->statePath('filters')
            ->extraAttributes([
                'class' => 'flex flex-wrap items-center justify-end gap-2',
            ])
            ->components([
                Select::make('period')
                    ->hiddenLabel()
                    ->native(false)
                    ->prefixIcon('heroicon-o-calendar-days')
                    ->options(fn (): array => DashboardAccess::pageFilterOptions())
                    ->default(fn (): string => array_key_first(DashboardAccess::pageFilterOptions()) ?? '7days')
                    ->visible(fn (): bool => DashboardAccess::pageFilterOptions() !== [])
                    ->live()
                    ->afterStateUpdated(function (mixed $state): void {
                        $this->setPeriod((string) $state);
                    })
                    ->grow(false)
                    ->extraFieldWrapperAttributes([
                        'class' => 'w-full sm:w-56',
                    ]),
                DatePicker::make('startDate')
                    ->hiddenLabel()
                    ->placeholder(__('app.dashboard.filters.start'))
                    ->visible(fn (Get $get): bool => $get('period') === 'custom' && array_key_exists('custom', DashboardAccess::pageFilterOptions()))
                    ->live()
                    ->grow(false)
                    ->extraFieldWrapperAttributes([
                        'class' => 'w-full sm:w-40',
                    ]),
                DatePicker::make('endDate')
                    ->hiddenLabel()
                    ->placeholder(__('app.dashboard.filters.end'))
                    ->visible(fn (Get $get): bool => $get('period') === 'custom' && array_key_exists('custom', DashboardAccess::pageFilterOptions()))
                    ->live()
                    ->grow(false)
                    ->extraFieldWrapperAttributes([
                        'class' => 'w-full sm:w-40',
                    ]),
            ]);
    }

    public function getColumns(): int|array
    {
        return [
            'default' => 1,
            'md' => 4,
        ];
    }

    /**
     * Render dashboard widgets in grouped layout blocks.
     */
    public function getWidgetsContentComponent(): Component
    {
        $this->filters = DashboardAccess::sanitizePageFilters($this->filters);

        $columns = $this->getColumns();

        return Grid::make(1)->schema([
            Grid::make($columns)->schema([
                ...$this->getWidgetsSchemaComponents([
                    MembershipMetricsWidget::class,
                ]),
            ]),
            Grid::make($columns)->schema(
                $this->getWidgetsSchemaComponents([
                    FinancialMetricsWidget::class,
                    ExpenseCategoriesDoughnutChartWidget::class,
                ]),
            ),
            Grid::make($columns)->schema([
                ...$this->getWidgetsSchemaComponents([
                    MembershipOverviewSubscriptionsTableWidget::class,
                    RecentTransactionsTableWidget::class,
                ]),
            ]),
            Grid::make($columns)->schema(
                $this->getWidgetsSchemaComponents([
                    CashflowTrendChartWidget::class,
                ]),
            ),
            Grid::make($columns)->schema(
                $this->getWidgetsSchemaComponents([
                    MemberTrendChartWidget::class,
                ]),
            ),
            // Row 6: Most Used Services Trend
            Grid::make($columns)->schema(
                $this->getWidgetsSchemaComponents([
                    TopServicesChartWidget::class,
                ]),
            ),
            // Row 7: 4 Pie charts placed side by side in a clean 2x2 grid!
            Grid::make(['default' => 1, 'md' => 2])->schema(
                $this->getWidgetsSchemaComponents([
                    MemberStatusPieChartWidget::class,
                    FinancialSummaryPieChartWidget::class,
                    MemberSourceChartWidget::class,
                    TopPlansChartWidget::class,
                ]),
            ),
        ]);
    }

    public function ensureDefaultFilters(): void
    {
        $this->filters = DashboardAccess::sanitizePageFilters($this->filters);

        $period = is_string($this->filters['period'] ?? null) ? $this->filters['period'] : '';

        if ($period === '') {
            $this->applyPresetRange(array_key_first(DashboardAccess::pageFilterOptions()) ?? '7days');
        }
    }

    public function setPeriod(string $period): void
    {
        $allowed = DashboardAccess::pageFilterOptions();

        if (! array_key_exists($period, $allowed)) {
            $period = array_key_first($allowed) ?? '7days';
        }

        if ($period === 'custom') {
            $this->filters = DashboardAccess::sanitizePageFilters([
                ...($this->filters ?? []),
                'period' => 'custom',
            ]);
            $this->updatedFilters();

            return;
        }

        $this->applyPresetRange($period);
    }

    public function applyCustomRangeFromFilters(): void
    {
        if (! array_key_exists('custom', DashboardAccess::pageFilterOptions())) {
            $this->filters = DashboardAccess::sanitizePageFilters($this->filters);
            $this->updatedFilters();

            return;
        }

        $startDate = is_string($this->filters['startDate'] ?? null) ? $this->filters['startDate'] : '';
        $endDate = is_string($this->filters['endDate'] ?? null) ? $this->filters['endDate'] : '';

        if (($startDate === '') || ($endDate === '')) {
            return;
        }

        $this->applyCustomRange($startDate, $endDate);
    }

    private function applyPresetRange(string $preset): void
    {
        $this->filters = DashboardAccess::sanitizePageFilters([
            'period' => $preset,
        ]);

        $this->updatedFilters();
    }

    private function applyCustomRange(string $startDate, string $endDate): void
    {
        $this->filters = DashboardAccess::sanitizePageFilters([
            'period' => 'custom',
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);

        $this->updatedFilters();
    }
}
