<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Show signup form
    public function showSignup()
    {
        return view('signup');
    }

    // Handle signup
    public function signup(Request $request)
    {
        $validator =Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:6',
            'day' => 'required|integer|between:1,31',
            'month' => 'required|string',
            'year' => 'required|integer|between:1900,2025',
            'gender' => 'required|in:male,female,custom',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'day' => $request->day,
            'month' => $request->month,
            'year' => $request->year,
            'gender' => $request->gender,
            'verification_code' => rand(100000, 999999),
            'image'=>"image/profile_pic.png",
        ]);

        // Auto login after signup
        Auth::login($user);
        Mail::raw('Your verification code is: ' . $user->verification_code, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Email Verification Code');
        });
        session(['email_for_verification' => $user->email]);
        //return response()->json(['message' => 'Verification code sent to your email.']);
        return redirect()->route('verify')->with('message', 'Verification code sent to your email.');
    }

    // Show login form
    public function showLogin()
    {
        return view('login');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user(); // Logged-in user

            // 3️⃣ Check if email is verified
            if (!$user->is_verified) {
                Mail::raw('Your verification code is: ' . $user->verification_code, function ($message) use ($user) {
                    $message->to($user->email)
                            ->subject('Email Verification Code');
                });
                session(['email_for_verification' => $user->email]);
                return redirect()->route('verify')
                                 ->with('error', 'Please verify your email first.');
            }
            return redirect()->route('hompage');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    // hompage
    public function hompage()
    {
        return view('hompage');
    }
    public function verifyCode(Request $request)
    {
        $request->validate(['code' => 'required']);
    
        $user = Auth::user();
    
        if ($user && $request->code == $user->verification_code) {
            $user->is_verified = true;
            $user->save();
            return redirect()->route('hompage')->with('success', 'Email verified successfully!');
        }
    
        return back()->with('error', 'Invalid verification code.');
    }
    public function verifyUser(Request $request){
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        $user->verification_code = rand(100000, 999999);
         $user->save();
        Auth::login($user);
        Mail::raw('Your verification code for password reset is: ' . $user->verification_code, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Password Verification Code');
        });
        session(['email_for_verification' => $user->email]);
        return redirect()->route('verify.user')->with('message', 'Verification code sent to your email.');
    }
    public function verifyPasscode(Request $request)
    {
        $request->validate(['code' => 'required']);
    
        $user = Auth::user();
    
        if ($user && $request->code == $user->verification_code) {
            
            return redirect()->route('reset-pass')->with('success', 'Email verified successfully!');
        }
    
        return back()->withErrors([
            'code' => 'Verification code is invalid.',
        ])->onlyInput('code');
    }
    public function verifypass(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
        ]);
        if( $request->password ==  $request->password_confirmation ){
            $user = Auth::user(); 
            $user->password =  $request->password;
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }
        return back()->withErrors(['error' => 'Password did not match']);
    }
   
}