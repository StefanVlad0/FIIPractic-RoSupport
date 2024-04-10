<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
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
    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', CommentController::class)->shallow();
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/message/{name}', [MessageController::class, 'create']);
    Route::post('/message/{name}', [MessageController::class, 'store']);
    Route::get('/users/{name}', function ($name) {
        $user = User::where('name', $name)->first();

        if ($user) {
            return view('users.show', ['user' => $user]);
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

Route::get('/dashboard', function () {
    $posts = App\Models\Post::all(); // sau orice altă logică pentru a prelua postările
    return view('dashboard', ['posts' => $posts]);
})->name('dashboard')->middleware('auth');



