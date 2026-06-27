<?php

namespace App\Filament\Widgets\Analytics;

use App\Helpers\Helpers;
use App\Models\InvoiceTransaction;
use App\Support\Dashboard\DashboardAccess;
use App\Support\Billing\PaymentMethod;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

/**
 * Recent invoice transactions table for the selected dashboard range.
 *
 * This helps users quickly verify payments/refunds without leaving the dashboard.
 */
class RecentTransactionsTableWidget extends TableWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = -35;

    protected static ?string $heading = null;

    /**
     * @var int | string | array<string, int | null>
     */
    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 2,
    ];

    public function table(Table $table): Table
    {
        $locked = ! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_RECENT_TRANSACTIONS);

        return $table
            ->paginated(false)
            ->heading($locked ? DashboardAccess::lockedHeading(__('app.widgets.recent_transactions')) : __('app.widgets.recent_transactions'))
            ->query(function () use ($locked): Builder {
                if ($locked) {
                    return InvoiceTransaction::query()->whereRaw('1 = 0');
                }

                $range = DashboardAccess::rangeFromPageFilters($this->pageFilters);

                return InvoiceTransaction::query()
                    ->with(['invoice'])
                    ->whereBetween('occurred_at', [$range->start, $range->end])
                    ->latest('occurred_at')
                    ->limit(5);
            })
            ->columns([
                TextColumn::make('invoice.number')
                    ->label(__('app.resources.invoices.singular'))
                    ->copyable()
                    ->wrap(),
                TextColumn::make('occurred_at')
                    ->label(__('app.fields.date'))
                    ->state(fn (InvoiceTransaction $record): string => $record->occurred_at?->timezone(\App\Support\AppConfig::timezone())->translatedFormat('d M Y') ?? '—')
                    ->description(fn (InvoiceTransaction $record): string => $record->occurred_at?->timezone(\App\Support\AppConfig::timezone())->format('h:i A') ?? '—')
                    ->sortable(),
                TextColumn::make('type')
                    ->label(__('app.fields.status'))
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'payment' => __('app.transactions.payment'),
                        'refund' => __('app.transactions.refund'),
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'payment' => 'success',
                        'refund' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('amount')
                    ->label(__('app.fields.amount'))
                    ->alignRight()
                    ->state(fn (InvoiceTransaction $record): string => ($record->type === 'refund' ? '-' : '').Helpers::formatCurrency((float) $record->amount)),
                TextColumn::make('payment_method')
                    ->label(__('app.fields.method'))
                    ->formatStateUsing(fn (?string $state): string => PaymentMethod::channelLabel($state)),
            ])
            ->emptyStateHeading($locked ? new HtmlString('<span>0</span> ' . Blade::render('<x-filament::icon icon="heroicon-m-lock-closed" class="h-5 w-5 text-warning-500 inline-block ml-1" />')) : __('app.widgets.recent_transactions'))
            ->emptyStateDescription($locked ? DashboardAccess::lockedMessage() : 'No recent transactions found for this period.');
    }
}
