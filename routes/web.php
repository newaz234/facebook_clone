<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
//Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::get('/verify', fn() => view('verify'))->name('verify');
Route::post('/verify', [AuthController::class, 'verifyCode'])->name('verify.code');




Route::get('/', function () {
    return redirect()->route('signup');
});

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::middleware('auth')->group(function () {
    Route::get('/hompage', [AuthController::class, 'hompage'])->name('hompage');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
