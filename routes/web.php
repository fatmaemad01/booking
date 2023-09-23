<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingRequestController;
use App\Models\Branch;
use App\Http\Controllers\BookingRequestResponseController;
use App\Http\Controllers\CalenderController;

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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/calender',[CalenderController::class , 'index'])->name('calender');



require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::resource('branch' , BranchController::class);
    Route::resource('branch.space' , SpaceController::class);
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::put('/profile/{user}', [UserController::class, 'useredit'])->name('profile.useredit');
    Route::get('/change-language/{locale}', [UserController::class, 'changeLanguage'])->name('change.language');

});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/{request}', [BookingRequestController::class, 'show'])->name('request.show');
    Route::put('/accept/{bookingRequest}', [BookingRequestResponseController::class, 'accept'])->name('request.accept');
    Route::put('/{bookingRequest}', [BookingRequestResponseController::class, 'reject'])->name('request.reject');
    Route::delete('/{bookingRequest}', [BookingRequestController::class, 'destroy'])->name('request.delete');
});

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('member/dashboard', [CalenderController::class, 'index'])->name('member.dashboard');
    Route::get('/member/request', [BookingRequestController::class, 'index'])->name('request.index');
    Route::post('/request', [BookingRequestController::class, 'store'])->name('request.store');
});



