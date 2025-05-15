<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller {
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    public function register(Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        Auth::login($user);

        return redirect()->route('store.avatar');
    }

    public function login(Request $request) {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);     

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            if (is_null(Auth::user()->avatar_source)) {
                return redirect()->route('show.avatar');
            }
            else {
                return redirect()->route('index.home');
            }
        }

        throw ValidationException::withMessages([
            'credentials' => 'Incorrect email or password'
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
