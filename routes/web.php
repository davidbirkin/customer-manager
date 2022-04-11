<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::view('settings', 'settings.index')->name('settings');

    Route::controller(RoleController::class)->group(function () {
        Route::get('roles', 'index')->name('roles.index');
        Route::post('roles/store', 'store')->name('roles.store');
    });

    Route::controller( UserController::class)->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::get('users/{user}/edit', 'edit')->name('users.edit');
        Route::post('users/{user}/update', 'update')->name('users.update');
    });
    
    Route::controller(ProfileController::class)->group(function () {
        Route::get('profile','show')->name('profile.show');
        Route::put('profile','update')->name('profile.update');
    });
});
