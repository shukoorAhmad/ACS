<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
// users routes
Route::get('/user-management-sys/{id?}', function ($id) {
    Session::put('system_id', $id);
    return view('auth.home');
})->name('user-management-sys');

Route::controller(App\Http\Controllers\Auth\UserController::class)->group(function () {
    Route::get('/users', 'index')->name('users');
    Route::post('/users-store', 'store')->name('users-store');
    Route::get('/users-edit', 'edit')->name('users-edit');
    Route::post('/users-update', 'update')->name('users-update');
    Route::get('/user-delete/{id?}', 'destroy')->name('user-delete');
    Route::post('change-user-password', 'change_password')->name('change-user-password');
    Route::post('change-user-image', 'changeUserImage')->name('change-user-image');
});

Route::controller(App\Http\Controllers\Auth\RoleController::class)->group(function () {
    Route::get('user-roles', 'index')->name('roles');
    Route::post('role-store', 'store')->name('role-store');
    Route::post('role-update', 'update')->name('role-update');
    Route::get('role-details/{type}', 'details')->name('role-details');
    Route::get('system-details', 'system_details')->name('system-details');
    Route::get('permission-details/{type}', 'permission_details')->name('permission-details');
});
