<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingRequestController;
use App\Models\Branch;
use App\Http\Controllers\BookingRequestResponseController;

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


require __DIR__ . '/auth.php';

Route::get('/space', [SpaceController::class ,'index'])->name('space.index');
// Route::get('branch/{branch}/spaces', [BranchController::class ,'showSpaces'])->name('branch.showSpaces');
Route::get('/branch/{branch}/space/{space}', [SpaceController::class ,'show'])->name('space.show');

Route::get('/branch', [ BranchController::class,'index'])->name('branch.index');
Route::get('/branch/{branch}',[BranchController::class, 'show'])->name('branch.show');
Route::get('branch/{branch}/spaces',[BranchController::class, 'showSpaces'])->name('branch.showSpaces');


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'show'])->name('profile.show');
    Route::put('/profile/{user}', [UserController::class, 'useredit'])->name('profile.useredit');
    Route::get('/change-language/{locale}', [UserController::class, 'changeLanguage'])->name('change.language');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [UserController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'role:member'])->group(function () {
    Route::get('member/dashboard', [UserController::class, 'memberDashboard'])->name('member.dashboard');
    Route::get('/request', [BookingRequestController::class, 'index'])->name('request.index');
    Route::post('/request', [BookingRequestController::class, 'store'])->name('request.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/{request}', [BookingRequestController::class, 'show'])->name('request.show');
    Route::put('/accept/{bookingRequest}', [BookingRequestResponseController::class, 'accept'])->name('request.accept');
    Route::put('/{bookingRequest}', [BookingRequestResponseController::class, 'reject'])->name('request.reject');
    Route::delete('/{bookingRequest}', [BookingRequestController::class, 'destroy'])->name('request.delete');
});

// Route::middleware(['auth'])->group(function () {





// });

Route::group([
    'as' => 'space.',
    'prefix' => 'space/',
    'controller' => SpaceController::class,
    'middleware' => ['auth', 'role:admin']
], function () {
    Route::post('new', 'store')->name('store');
    Route::put('{space}/update', 'update')->name('update');
    Route::delete('{space}', 'destroy')->name('destroy');
});

Route::group([
    'as'=> 'branch.',
    'prefix'=> 'branch/',
    'controller' => BranchController::class,
    'middleware' => ['auth', 'role:admin']
], function(){
    Route::post('', 'store')->name('store');
    Route::put('{branch}', 'update')->name('update');
    Route::delete('{branch}', 'destroy')->name('destroy');
});



