<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function loginView(Request $request)
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // validate email password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('client')->attempt($credentials)) {
            $user = Auth::guard('client')->user();
            Auth::guard('client')->login($user);
            Log::info('Login success', [$user]);
            return redirect('/dashboard');
        }

        return back()->withErrors([
            'email' => "L'email ou le mot de passe est incorrect."
        ])->onlyInput('email');

    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        return redirect('/auth/login');
    }
}
