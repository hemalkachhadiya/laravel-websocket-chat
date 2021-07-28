<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Event\NewChatMessage;

class ChatController extends Controller
{
    public function rooms(Request $request)
    {
        return ChatRoom::all();
    }

    public function messages(Request $request, $roomId)
    {
        return ChatMessage::where('chat_room_id', $roomId)
        ->with('user')
        ->orderBy('created_at', 'DESC')
        ->get();
    }
    
    public function newMessage(Request $request, $roomId)
    {
        $newMessage = new ChatMessage;
        $newMessage->user_id = Auth::id();
        $newMessage->chat_room_id = $roomId;
        $newMessage->message = $request->message;
        if ($request->hasFile('images')) {
            $fileName = time().'.'.$request->images->extension();
            $request->images->move(public_path('document'), $fileName);
            $newMessage->document = $fileName;
            $newMessage->doc_type = 'images';
        }
        if ($request->hasFile('videos')) {
            $fileName = time().'.'.$request->videos->extension();
            $request->videos->move(public_path('document'), $fileName);
            $newMessage->document = $fileName;
            $newMessage->doc_type = 'videos';
        }
        $newMessage->save();
        $newMessage->sendername = $newMessage->user->name;

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
