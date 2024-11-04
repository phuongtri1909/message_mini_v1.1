<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Support\Facades\Log;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        $this->message->load('sender');
        $this->message->sender->avatar_url = $this->message->sender->avatar ? asset($this->message->sender->avatar) 
        : asset('/assets/images/avatar_default.jpg');

        Log::info('Broadcasting MessageSent event for message ID: ' . $this->message->id);

        return new PrivateChannel('chat.'.$this->message->conversation->id);
    }
}
