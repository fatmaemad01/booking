<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::user()->role == 'admin'){
            $result = true;
        }else{
            $result= false;
        }
          return $result;
    }

    

    public function update(User $user, Branch $branch): bool
    {
        if(Auth::user()->role == 'admin'){
            $result = true;
        }else{
            $result= false;
        }
          return $result;
    }

    

    public function delete(User $user, Branch $branch): bool
    {
        if(Auth::user()->role == 'admin'){
            $result = true;
        }else{
            $result= false;
        }
          return $result;
    }
   

}
