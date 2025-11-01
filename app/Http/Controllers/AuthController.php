<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showRegister()
    {
        return view('user.user_register');
    }

    public function showLogin()
    {
        return view('user.user_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.user_dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials. Please try again.',
        ])->onlyInput('email');
    }


    public function register(Request $request)
    {

        $request->validate([
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required',
            'confirmPassword' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return back()->with('emailExists', true)->withInput();
        }

        if (strlen($request->password) < 6) {
            return back()->with('passwordShort', true)->withInput();
        }

        if ($request->password !== $request->confirmPassword) {
            return back()->with('passwordMismatch', true)->withInput();
        }

        User::create([
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('user.user_login')->with('success', 'Account created successfully! Please log in.');
    }

}
