<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

Route::get('/', function () {
    if (Auth::check()) {
        return view('dashboard');
    } else {
        return redirect('/login');
    }
});

Route::middleware(['auth'])->group(function () {
    Route::get('/message/{name}', [MessageController::class, 'create']);
    Route::post('/message/{name}', [MessageController::class, 'store']);
    Route::get('/users/{name}', function ($name) {
        $user = User::where('name', $name)->first();

        if ($user) {
            return view('users.show', ['name' => $name]);
        } else {
            return view('users.notfound');
        }
    })->name('users.show');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

