<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReferralController;
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
        $posts = App\Models\Post::latest()->get();;
        return view('dashboard', ['posts' => $posts]);
//        return view('dashboard');
    } else {
        return redirect('/login');
    }
})->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/messenger/users', function () {
        $userId = Auth::id();
        $users = DB::table('messages')
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->join('users', function ($join) use ($userId) {
                $join->on('users.id', '=', 'messages.sender_id')
                    ->orOn('users.id', '=', 'messages.receiver_id')
                    ->where('users.id', '!=', $userId);
            })
            ->select('users.*')
            ->distinct()
            ->get()
            ->where('id', '!=', $userId);

        foreach ($users as $user) {
            $lastMessage = DB::table('messages')
                ->where(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $userId)
                        ->where('receiver_id', $user->id);
                })
                ->orWhere(function ($query) use ($userId, $user) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', $userId);
                })
                ->orderBy('created_at', 'desc')
                ->first();

            if ($lastMessage) {
                $user->last_message = $lastMessage->content;
                $user->last_sender_id = $lastMessage->sender_id;
            }
        }

        return response()->json($users);
    });
    Route::post('/posts/{post}/like', [PostController::class, 'toggleLike'])->name('posts.like');
    Route::get('/qr-code', [ReferralController::class, 'generateQrCode'])->name('qr-code');
    Route::get('/referral', [ReferralController::class, 'show'])->name('referral');
    Route::resource('posts', PostController::class);
    Route::resource('products', ProductController::class);
    Route::resource('posts.comments', CommentController::class)->shallow();
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/message/{name}', [MessageController::class, 'create'])->name('message.create');
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
    Route::get('/invite/{name}', [AuthController::class, 'showInvitation'])->name('invite');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

//Route::get('/dashboard', function () {
//    $posts = App\Models\Post::all(); // sau orice altă logică pentru a prelua postările
//    return view('dashboard', ['posts' => $posts]);
//})->name('dashboard')->middleware('auth');



