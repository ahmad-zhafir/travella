<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        if (Auth::check()) {
            return redirect('/');
        }

        if ($request->has('redirect')) {
            $redirect = $request->input('redirect');
            if (!Str::contains($redirect, ['login', 'register'])) {
                session(['redirect_url' => $redirect]);
            }
        } else {
            $previous = url()->previous();
            if (!Str::contains($previous, ['login', 'register'])) {
                session(['redirect_url' => $previous]);
            }
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'userRole' => 'required|in:guest,host',
            'contact_no' => ['required', 'string', 'max:15'],
        ]);

        $user = User::create([
            'name' => $validated['fullname'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['userRole'],
            'contact_no' => $validated['contact_no'],
        ]);

        Auth::login($user);

        // Redirect logic
        if ($user->role === 'host') {
            return redirect()->route('host.dashboard');
        }

        $redirectUrl = session()->pull('redirect_url', '/');

        if (!Str::startsWith($redirectUrl, '/')) {
            $path = parse_url($redirectUrl, PHP_URL_PATH) ?: '/';
            $query = parse_url($redirectUrl, PHP_URL_QUERY);
            $redirectUrl = $path . ($query ? '?' . $query : '');
        }

        return redirect($redirectUrl);
    }
}
