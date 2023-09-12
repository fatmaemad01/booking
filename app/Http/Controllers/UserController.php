<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\Day;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    
    public function adminDashboard()
    {

        $requests = BookingRequest::all();

        return view('admin.dashboard' , compact('requests'));

    }

    public function memberDashboard()
    {
        $requests = BookingRequest::where('id' , '=' , Auth::id())->get();

        $spaces = Space::all();
        
        $days = Day::all();

        return view('member.dashboard' , [
            'requests' => $requests,
            'request' => new BookingRequest(),
            'spaces' => $spaces,
            'days' => $days
            ]);
    }

    public function index()
    {

        $users = User::all();
        return view('admin.member.index' , [
            'users' => $users,
            'user' => new User()
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', Password::defaults()],
            'phone' => ['required' , 'string' , 'min:10'],
            'role' => ['required' , 'string' , 'in:admin,member'],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back();
        
    }

    // public function edit(User $user)
    // {
    //     return view('admin.member.index');
    // }


    public function update(Request $request , User $user)
    {
        $request->validate([
            'first_name' => 'required'|'string',
            'last_name' => 'required'|'string',
            'email' => 'required'|'email',
            'phone' => 'required'|'string',
            'role' => 'in:admin,member',
            'personal_image' => 'image|nullable',
        ]);

        if ($request->hasFile('personal_image')) {
            $oldImagePath = $user->personal_image;
            if ($oldImagePath) {
                Storage::disk('userimages')->delete($oldImagePath);
            }

            // Upload the new image
            $file = $request->file('personal_image');
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('userimages' , $filename);
            $user->personal_image = $path;
        }

        $user->update($request->all());

        return redirect()->route('users.index' , $user->id);
    }

    public function destroy(User $user)
    {
        $user->delete();

        if ($user->personal_image) {
            Storage::disk('userimages')->delete($user->personal_image);
        }

        return back();
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {
            $user = Auth::user();

            if ($user) {
                $user->locale = $locale;
            } else {
                session(['locale' => $locale]);
            }

            App::setLocale($locale);
        }

        return redirect()->back();
    }


}
