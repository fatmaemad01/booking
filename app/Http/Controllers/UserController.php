<?php

namespace App\Http\Controllers;

use App\Models\BookingRequest;
use App\Models\Branch;
use App\Models\Day;
use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function show(User $model)
    {
        $this->authorize('view' , [User::class , $model]);

        $user = Auth::user();
        return view('admin.member.profile.show', compact('user'));
    }

    public function useredit(Request $request, User $user)
    {
        $this->authorize('update' , $user);

        $old_image = $user->personal_image;

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:10'],
            'personal_image' => 'image',
        ]);

        $inputData = $request->except('personal_image');

        if ($request->hasFile('personal_image')) {
            $file = $request->file('personal_image');
            $path = User::uploadImage($file);
            $inputData['personal_image'] = $path;
        }

        $user->update($inputData);

        if ($old_image && $old_image != $user->personal_image) {
            User::deleteImage($old_image);
        }

        return redirect()->route('profile.show');
    }

    
    public function index()
    {
        $this->authorize('viewAny' , [User::class]);
        $users = User::where('role' , 'member')->get();
        return view('admin.member.index', [
            'users' => $users,
            'user' => new User()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            // 'password' => ['required', Password::defaults()],
            'phone' => ['required', 'string', 'min:10'],
            'role' => ['required', 'string', 'in:admin,member'],
        ]);
        // $random_password = Str::random(12);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        event(new Registered($user));
        return redirect()->back();
    }


    public function update(Request $request, User $user)
    {
        $this->authorize('update' , $user);

        $request->validate([
            'first_name' => 'required' | 'string',
            'last_name' => 'required' | 'string',
            'email' => 'required' | 'email',
            'phone' => 'required' | 'string',
            'role' => 'in:admin,member',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index', $user->id);
    }

    public function destroy(User $user)
    {

        $this->authorize('delete' , $user);
        
        $user->delete();

        if ($user->personal_image) {
            Storage::disk('userimages')->delete($user->personal_image);
        }

        return back();
    }

    public function changeLanguage($locale)
    {
        if (in_array($locale, ['en', 'ar'])) {

            $user = User::where('id', Auth::id());

            if ($user) {
                $user->update(['locale' => $locale]);
            } else {
                session(['locale' => $locale]);
            }

            App::setLocale($locale);
        }

        return redirect()->back();
    }
}
