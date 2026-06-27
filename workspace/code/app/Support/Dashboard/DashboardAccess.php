<?php

namespace App\Support\Dashboard;

use App\Support\Analytics\AnalyticsDateRange;
use App\Support\AppConfig;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;

final class DashboardAccess
{
    public const ACCESS = 'Dashboard:Access';

    public const WIDGET_MEMBERSHIP_KPIS = 'Dashboard:MembershipKpiCards';
    public const WIDGET_FINANCIAL_KPIS = 'Dashboard:FinancialKpiCards';
    public const WIDGET_EXPENSE_OVERVIEW = 'Dashboard:ExpenseOverview';
    public const WIDGET_MEMBERSHIP_OVERVIEW_TABLE = 'Dashboard:MembershipOverviewTable';
    public const WIDGET_RECENT_TRANSACTIONS = 'Dashboard:RecentTransactions';
    public const WIDGET_CASHFLOW_CHART = 'Dashboard:CashflowChart';
    public const WIDGET_MEMBER_STATUS_CHART = 'Dashboard:MemberStatusChart';
    public const WIDGET_FINANCIAL_SUMMARY_CHART = 'Dashboard:FinancialSummaryChart';
    public const WIDGET_MEMBER_TREND_CHART = 'Dashboard:MemberTrendChart';
    public const WIDGET_MEMBER_SOURCE_CHART = 'Dashboard:MemberSourceChart';
    public const WIDGET_TOP_SERVICES_CHART = 'Dashboard:TopServicesChart';
    public const WIDGET_TOP_PLANS_CHART = 'Dashboard:TopPlansChart';

    public const METRIC_ACTIVE_MEMBERS = 'Dashboard:ActiveMembers';
    public const METRIC_NEW_MEMBERS = 'Dashboard:NewMembers';
    public const METRIC_RENEWALS = 'Dashboard:Renewals';
    public const METRIC_EXPIRED_MEMBERS = 'Dashboard:ExpiredMembers';
    public const METRIC_NET_REVENUE = 'Dashboard:NetRevenue';
    public const METRIC_TOTAL_COLLECTED = 'Dashboard:TotalCollected';
    public const METRIC_PENDING_PAYMENTS = 'Dashboard:PendingPayments';
    public const METRIC_EXPENSES = 'Dashboard:Expenses';
    public const METRIC_PROFIT = 'Dashboard:Profit';
    public const METRIC_LOSS = 'Dashboard:Loss';

    public const FILTER_7_DAYS = 'DashboardFilter:7Days';
    public const FILTER_30_DAYS = 'DashboardFilter:30Days';
    public const FILTER_MONTH = 'DashboardFilter:Month';
    public const FILTER_QUARTER = 'DashboardFilter:Quarter';
    public const FILTER_6_MONTHS = 'DashboardFilter:6Months';
    public const FILTER_YEAR = 'DashboardFilter:Year';
    public const FILTER_CUSTOM = 'DashboardFilter:Custom';

    /**
     * @return array<string, string>
     */
    public static function customPermissions(): array
    {
        return [
            self::ACCESS => 'Dashboard Access',
            self::WIDGET_MEMBERSHIP_KPIS => 'Dashboard Membership KPI Cards',
            self::WIDGET_FINANCIAL_KPIS => 'Dashboard Financial KPI Cards',
            self::WIDGET_EXPENSE_OVERVIEW => 'Dashboard Expense Overview Widget',
            self::WIDGET_MEMBERSHIP_OVERVIEW_TABLE => 'Dashboard Membership Overview Table',
            self::WIDGET_RECENT_TRANSACTIONS => 'Dashboard Recent Transactions Table',
            self::WIDGET_CASHFLOW_CHART => 'Dashboard Cashflow Chart',
            self::WIDGET_MEMBER_STATUS_CHART => 'Dashboard Member Status Pie Chart',
            self::WIDGET_FINANCIAL_SUMMARY_CHART => 'Dashboard Financial Summary Pie Chart',
            self::WIDGET_MEMBER_TREND_CHART => 'Dashboard Member Activity Trend Chart',
            self::WIDGET_MEMBER_SOURCE_CHART => 'Dashboard Member Source Pie Chart',
            self::WIDGET_TOP_SERVICES_CHART => 'Dashboard Top Services Chart',
            self::WIDGET_TOP_PLANS_CHART => 'Dashboard Top Plans Chart',
            self::METRIC_ACTIVE_MEMBERS => 'Dashboard Active Members Metric',
            self::METRIC_NEW_MEMBERS => 'Dashboard New Members Metric',
            self::METRIC_RENEWALS => 'Dashboard Renewals Metric',
            self::METRIC_EXPIRED_MEMBERS => 'Dashboard Expired Members Metric',
            self::METRIC_NET_REVENUE => 'Dashboard Net Revenue Metric',
            self::METRIC_TOTAL_COLLECTED => 'Dashboard Total Collected Metric',
            self::METRIC_PENDING_PAYMENTS => 'Dashboard Pending Payments Metric',
            self::METRIC_EXPENSES => 'Dashboard Expenses Metric',
            self::METRIC_PROFIT => 'Dashboard Profit Metric',
            self::METRIC_LOSS => 'Dashboard Loss Metric',
            self::FILTER_7_DAYS => 'Dashboard Filter 7 Days',
            self::FILTER_30_DAYS => 'Dashboard Filter 30 Days',
            self::FILTER_MONTH => 'Dashboard Filter Month',
            self::FILTER_QUARTER => 'Dashboard Filter Quarter',
            self::FILTER_6_MONTHS => 'Dashboard Filter 6 Months',
            self::FILTER_YEAR => 'Dashboard Filter Year',
            self::FILTER_CUSTOM => 'Dashboard Filter Custom Range',
        ];
    }

    public static function canAccessDashboard(): bool
    {
        return self::granted(self::ACCESS);
    }

    public static function allowsWidget(string $permission): bool
    {
        return self::canAccessDashboard() && self::granted($permission);
    }

    public static function allowsMetric(string $permission): bool
    {
        return self::canAccessDashboard() && self::granted($permission);
    }

    public static function allowsFilterPermission(string $permission): bool
    {
        return self::canAccessDashboard() && self::granted($permission);
    }

    /**
     * @return array<string, string>
     */
    public static function pageFilterOptions(): array
    {
        $options = [];

        if (self::allowsFilterPermission(self::FILTER_7_DAYS)) {
            $options['7days'] = __('app.dashboard.filters.periods.7days');
        }

        if (self::allowsFilterPermission(self::FILTER_30_DAYS)) {
            $options['30days'] = __('app.dashboard.filters.periods.30days');
        }

        if (self::allowsFilterPermission(self::FILTER_MONTH)) {
            $options['month'] = __('app.dashboard.filters.periods.month');
        }

        if (self::allowsFilterPermission(self::FILTER_QUARTER)) {
            $options['quarter'] = __('app.dashboard.filters.periods.quarter');
        }

        if (self::allowsFilterPermission(self::FILTER_YEAR)) {
            $options['year'] = __('app.dashboard.filters.periods.year');
        }

        if (self::allowsFilterPermission(self::FILTER_CUSTOM)) {
            $options['custom'] = __('app.dashboard.filters.periods.custom');
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public static function widgetFilterOptions(): array
    {
        $options = [];

        if (self::allowsFilterPermission(self::FILTER_7_DAYS)) {
            $options['7days'] = __('app.analytics.ranges.7days');
        }

        if (self::allowsFilterPermission(self::FILTER_30_DAYS)) {
            $options['30days'] = __('app.analytics.ranges.30days');
        }

        if (self::allowsFilterPermission(self::FILTER_QUARTER)) {
            $options['quarter'] = __('app.analytics.ranges.quarter');
        }

        if (self::allowsFilterPermission(self::FILTER_6_MONTHS)) {
            $options['6months'] = __('app.analytics.ranges.6months');
        }

        if (self::allowsFilterPermission(self::FILTER_YEAR)) {
            $options['ytd'] = __('app.analytics.ranges.ytd');
        }

        return $options;
    }

    /**
     * @param  array<string, mixed>|null  $filters
     * @return array<string, string>
     */
    public static function sanitizePageFilters(?array $filters): array
    {
        $allowed = self::pageFilterOptions();
        $allowedPeriods = array_keys($allowed);
        $fallback = $allowedPeriods[0] ?? '7days';

        $filters ??= [];
        $period = is_string($filters['period'] ?? null) ? $filters['period'] : $fallback;

        if (! in_array($period, $allowedPeriods, true)) {
            $period = $fallback;
        }

        if ($period !== 'custom') {
            return self::presetFilterState($period);
        }

        $timezone = AppConfig::timezone();
        $today = CarbonImmutable::today($timezone);
        $start = is_string($filters['startDate'] ?? null)
            ? CarbonImmutable::parse($filters['startDate'], $timezone)
            : $today->subDays(6);
        $end = is_string($filters['endDate'] ?? null)
            ? CarbonImmutable::parse($filters['endDate'], $timezone)
            : $today;

        if ($start->greaterThan($end)) {
            [$start, $end] = [$end, $start];
        }

        if ($end->greaterThan($today)) {
            $end = $today;
        }

        $maxDays = 366;

        if ($start->diffInDays($end) >= $maxDays) {
            $start = $end->subDays($maxDays - 1);
        }

        return [
            'period' => 'custom',
            'startDate' => $start->toDateString(),
            'endDate' => $end->toDateString(),
        ];
    }

    public static function sanitizeWidgetFilter(?string $filter): string
    {
        $allowed = array_keys(self::widgetFilterOptions());

        if ($allowed === []) {
            return '7days';
        }

        return is_string($filter) && in_array($filter, $allowed, true)
            ? $filter
            : $allowed[0];
    }

    /**
     * @param  array<string, mixed>|null  $filters
     */
    public static function rangeFromPageFilters(?array $filters): AnalyticsDateRange
    {
        return AnalyticsDateRange::fromFilters(self::sanitizePageFilters($filters));
    }

    public static function lockedHeading(string $heading): HtmlString
    {
        $icon = Blade::render('<x-filament::icon icon="heroicon-m-lock-closed" class="h-4 w-4 text-warning-500 inline-block ml-1.5" />');

        return new HtmlString('<span>' . e($heading) . $icon . '</span>');
    }

    public static function lockedMessage(): string
    {
        return 'Upgrade Account';
    }

    public static function zeroCurrency(): float
    {
        return 0.0;
    }

    /**
     * @return array<string, string>
     */
    private static function presetFilterState(string $period): array
    {
        $timezone = AppConfig::timezone();
        $today = CarbonImmutable::today($timezone);

        [$start, $end, $resolved] = match ($period) {
            '30days' => [$today->subDays(29), $today, '30days'],
            'month' => [$today->startOfMonth(), $today, 'month'],
            'quarter' => [$today->startOfQuarter(), $today, 'quarter'],
            'year' => [$today->startOfYear(), $today, 'year'],
            default => [$today->subDays(6), $today, '7days'],
        };

        return [
            'period' => $resolved,
            'startDate' => $start->toDateString(),
            'endDate' => $end->toDateString(),
        ];
    }

    private static function granted(string $permission): bool
    {
        $user = auth()->user();

        if (is_object($user) && method_exists($user, 'can')) {
            return (bool) $user->can($permission);
        }

        if (app()->runningUnitTests()) {
            return true;
        }

        return false;
    }
}
