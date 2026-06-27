<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\SystemPlan;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPlanPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SystemPlan');
    }

    public function view(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('View:SystemPlan');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SystemPlan');
    }

    public function update(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('Update:SystemPlan');
    }

    public function delete(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('Delete:SystemPlan');
    }

    public function restore(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('Restore:SystemPlan');
    }

    public function forceDelete(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('ForceDelete:SystemPlan');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SystemPlan');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SystemPlan');
    }

    public function replicate(AuthUser $authUser, SystemPlan $systemPlan): bool
    {
        return $authUser->can('Replicate:SystemPlan');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SystemPlan');
    }

}