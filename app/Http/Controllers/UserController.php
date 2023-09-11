<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'personal_image' => 'image|nullable'
        ]);

        if ($request->hasFile('personal_image')) {
            $oldImagePath = $user->personal_image;
            if ($oldImagePath) {
                Storage::disk('images')->delete($oldImagePath);
            }

            // Upload the new image
            $file = $request->file('personal_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('images' , $filename);
            $user->personal_image = $path;
        }

        $user->update($request->all());

        return redirect()->route('users.update' , $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        if ($user->personal_image) {
            Storage::disk('images')->delete($user->personal_image);
        }

        return back();
    }

}
