<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\UserController;
use App\Models\BookingRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {

    Route::get('/change-language/{locale}', [UserController::class, 'changeLanguage'])->name('change.language');
});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');



    Route::get('branch' , [BranchController::class , 'index'])->name('branch.index');
    Route::post('branch' , [BranchController::class , 'store'])->name('branch.store');
});

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('member/dashboard', [UserController::class, 'memberDashboard'])->name('member.dashboard');
});


Route::group([
    'as'=> 'space.',
    'prefix'=> 'space/',
    'controller' => SpaceController::class,
    'middleware' => 'auth, role:member'
], function(){
    Route::post('new', 'store')->name('store');
    Route::put('{space}/update', 'update')->name('update');
    Route::delete('{space}', 'destroy')->name('destroy');

});

