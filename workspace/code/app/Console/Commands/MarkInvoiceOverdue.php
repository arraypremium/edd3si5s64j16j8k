<?php

namespace App\Console\Commands;

use App\Models\Gym;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;

class MarkInvoiceOverdue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gymie:invoices {--mark-overdue : Mark invoices as overdue based on due date}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Perform operations on invoices (e.g., mark as overdue) and notify facility managers';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        if (! $this->option('mark-overdue')) {
            $this->info('No operation selected.');

            return self::SUCCESS;
        }

        $today = Carbon::today(\App\Support\AppConfig::timezone());

        $overdueInvoices = Invoice::query()
            ->whereIn('status', ['issued', 'partial'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $today)
            ->where('due_amount', '>', 0)
            ->get();

        $updatedCount = $overdueInvoices->count();

        if ($updatedCount > 0) {
            Invoice::query()
                ->whereIn('id', $overdueInvoices->pluck('id'))
                ->update(['status' => 'overdue']);

            foreach ($overdueInvoices->groupBy('gym_id') as $gymId => $invoices) {
                if (filled($gymId)) {
                    $gym = Gym::find($gymId);
                    if ($gym) {
                        $facilityManagers = $gym->users()->wherePivotIn('role', ['owner', 'manager'])->get();
                        foreach ($facilityManagers as $manager) {
                            Notification::make()
                                ->title("Facility Billing Alert: " . $gym->name)
                                ->body("{$invoices->count()} invoice(s) have rolled over into an OVERDUE state. Please review outstanding accounts.")
                                ->warning()
                                ->sendToDatabase($manager);
                        }
                    }
                }
            }

            // Notify Master Site Super Admin
            $admin = User::role('super_admin')->first();
            if ($admin) {
                Notification::make()
                    ->title("Platform Billing Update")
                    ->body("{$updatedCount} total invoice(s) marked as overdue across the platform.")
                    ->warning()
                    ->sendToDatabase($admin);
            }
        }

        $this->info("{$updatedCount} invoice(s) marked as overdue.");

        return self::SUCCESS;
    }
}
