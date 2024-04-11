<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if ($request->inviter_id) {
            $inviter = User::find($request->inviter_id);
            if ($inviter) {
                $inviter->points += 3;
                $user->points = 1;
                $inviter->save();
            }
        }

        $user->save();

        return redirect('/login');
    }
}
