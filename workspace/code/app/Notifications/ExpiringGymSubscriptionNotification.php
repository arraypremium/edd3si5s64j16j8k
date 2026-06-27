<?php

namespace App\Notifications;

use App\Models\Gym;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

/**
 * Sent daily to BOTH system admins and gym owners when a gym's
 * subscription is expiring within N days (default 10).
 *
 * (Prompt 6.1 — Decoupled notification for expiry alerts)
 */
class ExpiringGymSubscriptionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Gym $gym,
        public int $daysRemaining
    ) {}

    /**
     * Delivery channels.
     *
     * @param  object  $notifiable
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Payload stored in `notifications` table — drives dashboard bell icons.
     *
     * @param  object  $notifiable
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'gym_id' => $this->gym->id,
            'gym_name' => $this->gym->name,
            'gym_slug' => $this->gym->slug ?? null,
            'expiry_date' => $this->gym->expiry_date?->toDateString(),
            'days_remaining' => $this->daysRemaining,
            'severity' => $this->daysRemaining <= 3 ? 'critical' : ($this->daysRemaining <= 7 ? 'warning' : 'info'),
            'message' => "Business '{$this->gym->name}' subscription expires in {$this->daysRemaining} day(s).",
            'icon' => 'heroicon-o-clock',
            'color' => $this->daysRemaining <= 3 ? 'danger' : ($this->daysRemaining <= 7 ? 'warning' : 'info'),
        ];
    }

    /**
     * Send notification to ALL active system admins (central dashboard).
     */
    public static function sendToSystemAdmins(Gym $gym, int $daysRemaining): void
    {
        $admins = \App\Models\SystemAdmin::query()
            ->where('status', 'active')
            ->get();

        if ($admins->isEmpty()) {
            return;
        }

        \Illuminate\Support\Facades\Notification::send(
            $admins,
            new self($gym, $daysRemaining)
        );
    }

    /**
     * Send notification to gym's owner/manager (their dashboard).
     */
    public static function sendToGymOwners(Gym $gym, int $daysRemaining): void
    {
        $recipients = $gym->users()
            ->wherePivotIn('role', ['owner', 'manager'])
            ->get();

        if ($recipients->isEmpty()) {
            return;
        }

        \Illuminate\Support\Facades\Notification::send(
            $recipients,
            new self($gym, $daysRemaining)
        );
    }
}
