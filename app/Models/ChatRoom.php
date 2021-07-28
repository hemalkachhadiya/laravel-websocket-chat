<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChatMessage;
use App\Models\Room_log;
class ChatRoom extends Model
{
    use HasFactory;

    public function message()
    {
        return $this->hasMany(ChatMessage::class);
    }
    
    public function room_log()
    {
        return $this->hasMany(Room_log::class);
    }

    
}
