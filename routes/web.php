<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;

Illuminate\Support\Facades\Auth::routes();

Route::get('/', function () {
    if (session()->get('locale') == null || session()->get('locale') == 'null')
        Session::put('locale', Config::get('app.locale'));
    return redirect()->route('login');
})->name('/');

Route::get('verify-employee/{id}', function ($id) {
    return view('acs.employee.verify', compact('id'));
})->name('verify-employee');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // language management routes
    require __DIR__ . './lang_routes.php';

    // user management routes
    require __DIR__ . './user_routes.php';

    //    Access Control System routes
    require __DIR__ . './acs_routes.php';
});
