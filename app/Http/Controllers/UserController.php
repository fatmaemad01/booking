<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function index(User $user)
    {
        $users = User::all();
        return view('users.index' , compact('users'));
    }

    public function edit()
    {
        return view('users.edit');
    }

    public function update(Request $request , User $user)
    {
        $request->validate([
            'first_name' => 'required'|'string',
            'last_name' => 'required'|'string',
            'email' => 'required'|'email',
            'phone' => 'required'|'string',
            'role' => 'in:admin,member',
        ]);

        $user->update($request->all());

        return redirect()->route('users.update' , $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }

}
