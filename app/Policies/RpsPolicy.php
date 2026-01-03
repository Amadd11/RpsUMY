<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Rps;
use Illuminate\Auth\Access\HandlesAuthorization;

class RpsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Rps');
    }

    public function view(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('View:Rps');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Rps');
    }

    public function update(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('Update:Rps');
    }

    public function delete(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('Delete:Rps');
    }

    public function restore(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('Restore:Rps');
    }

    public function forceDelete(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('ForceDelete:Rps');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Rps');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Rps');
    }

    public function replicate(AuthUser $authUser, Rps $rps): bool
    {
        return $authUser->can('Replicate:Rps');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Rps');
    }

}