<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    // Show login form
public function showLoginForm(Request $request)
{
    if (Auth::check()) {
        return redirect('/');
    }

    if ($request->has('redirect')) {
        $redirect = $request->input('redirect');

        if (!Str::contains($redirect, 'login')) {
            session(['redirect_url' => $redirect]);
        }
    } else {
        $previous = url()->previous();

        if (!Str::contains($previous, 'login')) {
            session(['redirect_url' => $previous]);
        }
    }

    return view('auth.login');
}


    // Handle login request
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'host') {
            // Always redirect hosts to the dashboard
            return redirect()->route('host.dashboard');
        }

        // For other roles, keep existing redirect logic
        $redirectUrl = session()->pull('redirect_url', '/');

        if (!Str::startsWith($redirectUrl, '/')) {
            $path = parse_url($redirectUrl, PHP_URL_PATH) ?: '/';
            $query = parse_url($redirectUrl, PHP_URL_QUERY);
            $redirectUrl = $path . ($query ? '?' . $query : '');
        }

        return redirect($redirectUrl);
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}




public function logout()
    {
        // Log the user out
        Auth::logout();

        // Redirect to the home page after logout
        return redirect()->route('home');  // Ensure 'home' is the correct route name
    }

}