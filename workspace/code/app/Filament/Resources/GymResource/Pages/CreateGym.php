<?php

namespace App\Filament\Resources\GymResource\Pages;

use App\Filament\Resources\GymResource;
use App\Models\GymSubscription;
use App\Models\SystemPlan;
use App\Models\User;
use App\Support\Roles\BusinessRoleManager;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateGym extends CreateRecord
{
    protected static string $resource = GymResource::class;

    protected ?array $userData = null;

    protected ?array $subscriptionData = null;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $this->userData = [
            'name' => $data['user_name'] ?? null,
            'username' => $data['user_username'] ?? null,
            'password' => $data['user_password'] ?? null,
            'role' => $data['user_role'] ?? null,
        ];

        unset($data['user_name'], $data['user_username'], $data['user_password'], $data['user_role']);

        $this->subscriptionData = [
            'system_plan_id' => $data['subscription_system_plan_id'] ?? null,
            'start_date' => $data['subscription_start_date'] ?? null,
            'end_date' => $data['subscription_end_date'] ?? null,
        ];

        unset(
            $data['subscription_system_plan_id'],
            $data['subscription_start_date'],
            $data['subscription_end_date']
        );

        return $data;
    }

    protected function afterCreate(): void
    {
        $gym = $this->record;

        if ($this->userData && filled($this->userData['username'] ?? null) && filled($this->userData['role'] ?? null)) {
            $createdUser = User::updateOrCreate(
                ['username' => $this->userData['username']],
                [
                    'name' => $this->userData['name'],
                    'password' => Hash::make((string) $this->userData['password']),
                    'status' => 'active',
                ]
            );

            BusinessRoleManager::assignUserToGymRole($createdUser, $gym, (string) $this->userData['role']);
        }

        if ($this->subscriptionData && filled($this->subscriptionData['system_plan_id'] ?? null)) {
            $planId = $this->subscriptionData['system_plan_id'];
            $plan = SystemPlan::find($planId);

            $startDate = $this->subscriptionData['start_date'] ?: now()->toDateString();
            $endDate = $this->subscriptionData['end_date']
                ?: ($plan ? now()->addDays((int) $plan->days)->toDateString() : now()->addDays(30)->toDateString());

            $status = GymSubscription::deriveStatus($startDate, $endDate);

            try {
                DB::transaction(function () use ($gym, $planId, $startDate, $endDate, $status) {
                    $subscription = GymSubscription::create([
                        'gym_id' => $gym->id,
                        'system_plan_id' => $planId,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                        'status' => $status,
                    ]);

                    $gym->syncSubscriptionStatus();

                    Notification::make()
                        ->title('Business & Subscription created')
                        ->body("Gym #{$gym->assigned_id} • Plan: " . ($subscription->systemPlan->name ?? 'N/A') . " • {$startDate} → {$endDate}")
                        ->success()
                        ->send();
                });
            } catch (\Throwable $e) {
                \Illuminate\Support\Facades\Log::warning('GymSubscription auto-create failed', [
                    'gym_id' => $gym->id,
                    'error' => $e->getMessage(),
                ]);

                Notification::make()
                    ->title('Subscription not created')
                    ->body('Gym and user were created successfully, but subscription failed: ' . $e->getMessage())
                    ->warning()
                    ->persistent()
                    ->send();
            }
        }
    }
}
