<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\GymSubscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class GymSubscriptionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:GymSubscription');
    }

    public function view(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('View:GymSubscription');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:GymSubscription');
    }

    public function update(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('Update:GymSubscription');
    }

    public function delete(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('Delete:GymSubscription');
    }

    public function restore(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('Restore:GymSubscription');
    }

    public function forceDelete(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('ForceDelete:GymSubscription');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:GymSubscription');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:GymSubscription');
    }

    public function replicate(AuthUser $authUser, GymSubscription $gymSubscription): bool
    {
        return $authUser->can('Replicate:GymSubscription');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:GymSubscription');
    }

}