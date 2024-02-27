<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::get('/language/{lang}', function ($lang) {
    Session::put('locale', $lang);
    $language = \App\Models\Auth\UserLanguage::where('user_id', uid())->first();
    if ($language) {
        $language->language = $lang;
        $language->update();
    } else {
        $insert = new \App\Models\Auth\UserLanguage();
        $insert->user_id = uid();
        $insert->language = $lang;
        $insert->save();
    }
    return redirect()->back();
})->name('language');
