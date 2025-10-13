<?php use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AuthController; 
 use Illuminate\Foundation\Auth\EmailVerificationRequest;
  use Illuminate\Http\Request;
  use App\Http\Controllers\PostController; 
  //Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
   Route::get('/verify', fn() => view('verify'))->name('verify');
    Route::post('/verify', [AuthController::class, 'verifyCode'])->name('verify.code'); 
    Route::get('/', function () { return redirect()->route('signup'); }); 
    Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup'); 
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.store'); 
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login'); 
    Route::post('/login', [AuthController::class, 'login'])->name('login.store'); 
    Route::middleware('auth')->group(function () { 
        //Route::get('/hompage', [AuthController::class, 'hompage'])->name('hompage');
         Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
         Route::get('/hompage', [PostController::class, 'index'])->name('hompage');
         Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
         Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        });
    Route::get('/forget-password', fn() => view('forget-pass'))->name('forget-pass');
    Route::get('/reset-password', fn() => view('reset-pass'))->name('reset-pass');
//
    Route::get('/forget-password/verify', fn() => view('verifypass'))->name('verify.user');
    Route::post('/forget-password/verify', [AuthController::class, 'verifyUser'])->name('verify.user'); 
    Route::post('/reset-password/verify', [AuthController::class, 'verifypasscode'])->name('verify.pass');
    Route::post('/back-to-login', [AuthController::class, 'verifypass'])->name('verify.password');