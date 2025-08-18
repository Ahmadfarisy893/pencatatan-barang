<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $title = 'Register';
        return view('auth.register', compact('title'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user =User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'Admin',
        ]);

        return redirect()->route('login')->with('success', 'Registration successful. Please log in.');
    }
    public function showLoginForm() {
        $title = 'Login';
        return view('auth.login', compact('title'));
    }
    public function login(Request $request)
    {   
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
        'g-recaptcha-response' => 'required',
    ]);

     // Verifikasi captcha ke Google
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret' => env('RECAPTCHA_SECRET_KEY'),
        'response' => $request->input('g-recaptcha-response'),
        'remoteip' => $request->ip(),
    ]);

    if (! $response->json()['success']) {
        return back()->withErrors(['g-recaptcha-response' => 'Captcha verification failed.'])->withInput();
    }

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return back()
            ->withErrors(['email' => 'Email or password is incorrect.'])
            ->withInput();
    }

    Auth::login($user, $request->filled('remember'));

    $request->session()->regenerate();

    return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
