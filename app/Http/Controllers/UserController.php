<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    

    public function adminDashboard()
    {

        return view('admin.dashboard');
        
    }

    public function memberDashboard()
    {

        return view('member.dashboard');

    }

    // update , delete , modify the register and user model 
}
