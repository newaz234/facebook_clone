<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // যদি user logged in এবং verified না হয়ে থাকে
        if ($user && !$user->email_verified) {
            // redirect to verification page
            return redirect()->route('verify')->with('error', 'Please verify your email first.');
        }

        return $next($request);
    }
}
