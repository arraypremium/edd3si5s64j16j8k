<?php

namespace App\Http\Middleware;

use App\Filament\Pages\Billing;
use App\Models\Gym;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Spatie\Permission\PermissionRegistrar;
use Symfony\Component\HttpFoundation\Response;

class CheckGymStatus
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (class_exists(Filament::class)) {
            $tenant = Filament::getTenant();

            if ($tenant instanceof Gym) {
                session(['active_gym_id' => $tenant->id]);

                if (function_exists('setPermissionsTeamId')) {
                    setPermissionsTeamId($tenant->id);
                }

                app(PermissionRegistrar::class)->setPermissionsTeamId($tenant->id);

                $user = auth()->user();

                if ($user && method_exists($user, 'unsetRelation')) {
                    $user->unsetRelation('roles');
                    $user->unsetRelation('permissions');
                }

                $isSuperAdmin = $user && method_exists($user, 'isSuperAdmin') && $user->isSuperAdmin();

                if (! $isSuperAdmin && ($tenant->isSuspended() || $tenant->status === 'inactive')) {
                    if ($request->expectsJson() || $request->is('api/*')) {
                        return response()->json([
                            'message' => 'Access to this facility has been temporarily suspended by Site Administration.',
                            'gym' => $tenant->name,
                            'status' => $tenant->status,
                        ], 403);
                    }

                    return response()->view('errors.gym-suspended', ['gym' => $tenant], 403);
                }

                $subscriptionStatus = $tenant->subscription_status ?? 'none';
                $isRestricted = in_array($subscriptionStatus, ['none', 'expired'], true);

                if (! $isSuperAdmin && $isRestricted) {
                    $billingUrl = Billing::getUrl(tenant: $tenant);
                    $currentUrl = $request->fullUrl();

                    if (! str_contains($currentUrl, '/billing')
                        && ! str_contains($currentUrl, '/logout')
                        && ! str_contains($currentUrl, '/livewire')) {
                        return redirect()->to($billingUrl);
                    }
                }
            }
        }

        return $next($request);
    }
}
