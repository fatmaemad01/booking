<?php

namespace App\Policies;

use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SpacePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Space $space): bool
    {
        return true;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Space $space): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Space $space): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }

}
