<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{

    public function viewAny(User $user): bool
    {
        return true;
    }


    public function view(User $user, Branch $branch): bool
    {
        return true;
    }


    public function create(User $user): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }


    public function update(User $user, Branch $branch): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }


    public function delete(User $user, Branch $branch): bool
    {
        return $user->where('role' , 'admin')
        ->exists();
    }

}
