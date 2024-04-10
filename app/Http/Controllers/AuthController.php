<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended();
        }

        return back()->withErrors([
            'login_error' => 'The provided credentials do not match our records.',
        ]);
    }

    public function showInvitation($name)
    {
        $inviter = User::where('name', $name)->first();

        if ($inviter) {
            return view('invitation', ['inviter' => $inviter]);
        } else {
            return view('user_not_found');
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect('/login');
    }
}
