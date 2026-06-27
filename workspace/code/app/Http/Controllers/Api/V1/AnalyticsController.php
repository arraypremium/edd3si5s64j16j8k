<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\V1\InvoiceTransactionResource;
use App\Models\InvoiceTransaction;
use App\Services\Analytics\AnalyticsService;
use App\Support\Dashboard\DashboardAccess;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Read-only analytics endpoints for dashboards / reports.
 */
class AnalyticsController extends ApiController
{
    /**
     * Get financial KPIs for a range.
     */
    public function financial(Request $request): JsonResponse
    {
        $range = DashboardAccess::rangeFromPageFilters($request->all());
        $metrics = app(AnalyticsService::class)->financialMetrics($range);

        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_FINANCIAL_KPIS)) {
            $metrics = [
                'net_revenue' => 0,
                'collected' => 0,
                'refunds' => 0,
                'discounts' => 0,
                'outstanding' => 0,
                'expenses' => 0,
                'profit' => 0,
            ];
        } else {
            $metrics['net_revenue'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_NET_REVENUE) ? $metrics['net_revenue'] : 0;
            $metrics['collected'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_TOTAL_COLLECTED) ? $metrics['collected'] : 0;
            $metrics['outstanding'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_PENDING_PAYMENTS) ? $metrics['outstanding'] : 0;
            $metrics['expenses'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPENSES) ? $metrics['expenses'] : 0;
            $metrics['profit'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_PROFIT) ? $metrics['profit'] : 0;
        }

        return response()->json([
            'data' => [
                'range' => [
                    'start' => $range->start->toDateString(),
                    'end' => $range->end->toDateString(),
                ],
                'metrics' => $metrics,
            ],
        ]);
    }

    /**
     * Get membership KPIs for a range.
     */
    public function membership(Request $request): JsonResponse
    {
        $range = DashboardAccess::rangeFromPageFilters($request->all());
        $metrics = app(AnalyticsService::class)->membershipMetrics($range);

        if (! DashboardAccess::allowsWidget(DashboardAccess::WIDGET_MEMBERSHIP_KPIS)) {
            $metrics = [
                'active_members' => 0,
                'new_signups' => 0,
                'renewals' => 0,
                'expired_not_renewed' => 0,
            ];
        } else {
            $metrics['active_members'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_ACTIVE_MEMBERS) ? $metrics['active_members'] : 0;
            $metrics['new_signups'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_NEW_MEMBERS) ? $metrics['new_signups'] : 0;
            $metrics['renewals'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_RENEWALS) ? $metrics['renewals'] : 0;
            $metrics['expired_not_renewed'] = DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPIRED_MEMBERS) ? $metrics['expired_not_renewed'] : 0;
        }

        return response()->json([
            'data' => [
                'range' => [
                    'start' => $range->start->toDateString(),
                    'end' => $range->end->toDateString(),
                ],
                'metrics' => $metrics,
            ],
        ]);
    }

    /**
     * Cashflow trend (collected vs expenses).
     */
    public function cashflowTrend(Request $request): JsonResponse
    {
        $range = DashboardAccess::rangeFromPageFilters($request->all());
        $service = app(AnalyticsService::class);

        $days = $range->end->diffInDays($range->start) + 1;
        $grouping = $days <= 31 ? 'day' : 'month';

        $collected = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_CASHFLOW_CHART)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_TOTAL_COLLECTED)
            ? ($grouping === 'day' ? $service->collectedTrendByDate($range) : $service->collectedTrendByMonth($range))
            : [];

        $expenses = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_CASHFLOW_CHART)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPENSES)
            ? ($grouping === 'day' ? $service->expenseTrendByDate($range) : $service->expenseTrendByMonth($range))
            : [];
        $labels = collect(array_keys($collected))
            ->merge(array_keys($expenses))
            ->unique()
            ->sort()
            ->values()
            ->all();

        $collectedSeries = [];
        $expenseSeries = [];

        foreach ($labels as $label) {
            $collectedSeries[] = (float) ($collected[$label] ?? 0);
            $expenseSeries[] = (float) ($expenses[$label] ?? 0);
        }

        return response()->json([
            'data' => [
                'grouping' => $grouping,
                'labels' => $labels,
                'series' => [
                    'collected' => $collectedSeries,
                    'expenses' => $expenseSeries,
                ],
            ],
        ]);
    }

    /**
     * Expense breakdown by category for a range.
     */
    public function expenseCategories(Request $request): JsonResponse
    {
        $range = DashboardAccess::rangeFromPageFilters($request->all());
        $rows = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_EXPENSE_OVERVIEW)
            && DashboardAccess::allowsMetric(DashboardAccess::METRIC_EXPENSES)
            ? app(AnalyticsService::class)->expenseBreakdownByCategory($range, 10)
            : collect();

        return response()->json([
            'data' => $rows->values()->all(),
        ]);
    }

    /**
     * Top plans by collected amount.
     */
    public function topPlans(Request $request): JsonResponse
    {
        $range = DashboardAccess::rangeFromPageFilters($request->all());
        $rows = DashboardAccess::canAccessDashboard()
            ? app(AnalyticsService::class)->topPlansByCollected($range, 5)
            : collect();

        return response()->json([
            'data' => $rows->values()->all(),
        ]);
    }

    /**
     * Recent invoice transactions (payments/refunds).
     */
    public function recentTransactions(Request $request): AnonymousResourceCollection
    {
        $limit = (int) $request->query('limit', 5);
        $limit = $limit > 0 ? min($limit, 50) : 5;

        $rows = DashboardAccess::allowsWidget(DashboardAccess::WIDGET_RECENT_TRANSACTIONS)
            ? InvoiceTransaction::query()
                ->with([
                    'invoice.subscription.member',
                    'invoice.subscription.plan',
                ])
                ->orderByDesc('occurred_at')
                ->limit($limit)
                ->get()
            : collect();

        return InvoiceTransactionResource::collection($rows);
    }
}
