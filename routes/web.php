<?php

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
});
Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::get('/hompage', function () {
    return view('hompage');
});
Route::get('/profile', function () {
    return view('profile');
});
