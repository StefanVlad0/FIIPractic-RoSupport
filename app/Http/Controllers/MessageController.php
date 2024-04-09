<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class MessageController extends Controller
{
    public function create($name)
    {
        $receiver = User::where('name', $name)->first();

        $messages = Message::where(function ($query) use ($receiver) {
            $query->where('receiver_id', $receiver->id)
                ->where('sender_id', auth()->id());
        })->orWhere(function ($query) use ($receiver) {
            $query->where('sender_id', $receiver->id)
                ->where('receiver_id', auth()->id());
        })->get();

        return view('message', ['receiver' => $receiver, 'messages' => $messages]);
    }

    public function store(Request $request, $name)
    {
        $receiver = User::where('name', $name)->first();

        $message = new Message;
        $message->sender_id = auth()->id();
        $message->receiver_id = $receiver->id;
        $message->content = $request->content;
        $message->save();

        return redirect('/message/' . $name);
    }
}
