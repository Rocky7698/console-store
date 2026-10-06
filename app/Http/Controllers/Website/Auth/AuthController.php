<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login Page + Logic
     */
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                $request->session()->regenerate();
                return redirect()->route('website.home');
            }

            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->onlyInput('email');
        }

        return view('website.auth.login');
    }

    /**
     * Register Page + Logic
     */
    public function register(Request $request)
    {
        if ($request->isMethod('post')) {

            $request->validate([
                'name'      => 'required|string|max:255',
                'email'     => 'required|email|unique:users,email',
                'password'  => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password),
            ]);

            Auth::login($user);
            $request->session()->regenerate();

            return redirect()->route('website.home');
        }

        return view('website.auth.register');
    }

    /**
     * Logout User
     */
    public function logout(Request $request)
    {
        Auth::logout(); // default is 'web'
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('website.auth.login');
    }
}
