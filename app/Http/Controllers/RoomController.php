<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Room_log;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function createnewroom(Request $request)
    {
        $data = [];
        $newuser_id = User::where('email', $request->email)->first()->id;
        $data['room'] = Room_log::whereIn('user_id', [$newuser_id,  Auth::user()->id])->where('type', 'private')->get();
        
        if ($data['room']->count() < 1) {
            $createnewroom = new ChatRoom;
            $createnewroom->save();
            
            $newroom_log1 = new Room_log;
            $newroom_log1->room_id = $createnewroom->id;
            $newroom_log1->user_id = $newuser_id;
            $newroom_log1->type = "private";
            $newroom_log1->save();

            $newroom_log2 = new Room_log;
            $newroom_log2->room_id = $createnewroom->id;
            $newroom_log2->user_id = Auth::user()->id;
            $newroom_log2->type = "private";
            $newroom_log2->save();

            $data['room'] = Room_log::whereIn('user_id', [$newuser_id,  Auth::user()->id])->where('type', 'private')->get();
        }

        return response()->json($data, 200);
    }

    public function roomdetails(Request $request)
    {
        $data = [];
        $room = ChatRoom::where('id', $request->room_id)->first();
        if ($room->name == null) {
            $data['type'] = 'private';
            $room_logs = Room_log::where('room_id', $request->room_id)->where('type', 'private')->whereNotIn('user_id',[Auth::user()->id])->first();
            $user_name = User::where('id', $room_logs->user_id)->first()->name;
            $data['name'] = $user_name;

        } else {
            $data['name'] = $room->name;
            $data['type'] = 'group';
            $room_logs = Room_log::where('room_id', $request->room_id)->where('type', 'group')->get();
            $usernames = "You ";
            foreach ($room_logs as $key) {
                if ($key != Auth::user()->id) {
                    $user_name = User::where('id', $key->user_id)->first()->name;
                    $usernames = $usernames." ,".$user_name;
                }
            }

            $data['usernames'] = $usernames;
        }
        return response()->json($data,200);
    }
}
