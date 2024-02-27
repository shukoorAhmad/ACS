<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/acs-sys/{id?}', function ($id) {
    Session::put('system_id', $id);
    return view('acs.home');
})->name('acs-sys');

Route::controller(App\Http\Controllers\Acs\EmployeeController::class)->group(function () {
    Route::get('/employees', 'index')->name('employees');
    Route::post('/employee-store', 'store')->name('employee-store');
    Route::get('/employee-print-card/{id?}', 'print')->name('employee-print-card');
    Route::get('/employee-checks', 'check_index')->name('employee-checks');
    Route::get('/employee-check/{id?}', 'check')->name('employee-check');
    Route::get('/employee-destroy/{id?}', 'destroy')->name('employee-destroy');
});
