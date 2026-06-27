<?php

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemAdminPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:SystemAdmin');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('View:SystemAdmin');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:SystemAdmin');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('Update:SystemAdmin');
    }

    public function delete(AuthUser $authUser): bool
    {
        return $authUser->can('Delete:SystemAdmin');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('Restore:SystemAdmin');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDelete:SystemAdmin');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:SystemAdmin');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:SystemAdmin');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('Replicate:SystemAdmin');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:SystemAdmin');
    }

}