<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Cpl;
use Illuminate\Auth\Access\HandlesAuthorization;

class CplPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Cpl');
    }

    public function view(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('View:Cpl');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Cpl');
    }

    public function update(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('Update:Cpl');
    }

    public function delete(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('Delete:Cpl');
    }

    public function restore(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('Restore:Cpl');
    }

    public function forceDelete(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('ForceDelete:Cpl');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Cpl');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Cpl');
    }

    public function replicate(AuthUser $authUser, Cpl $cpl): bool
    {
        return $authUser->can('Replicate:Cpl');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Cpl');
    }

}