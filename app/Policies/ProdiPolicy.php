<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Prodi;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProdiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Prodi');
    }

    public function view(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('View:Prodi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Prodi');
    }

    public function update(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('Update:Prodi');
    }

    public function delete(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('Delete:Prodi');
    }

    public function restore(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('Restore:Prodi');
    }

    public function forceDelete(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('ForceDelete:Prodi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Prodi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Prodi');
    }

    public function replicate(AuthUser $authUser, Prodi $prodi): bool
    {
        return $authUser->can('Replicate:Prodi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Prodi');
    }

}