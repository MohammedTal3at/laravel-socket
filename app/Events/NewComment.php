<?php

namespace App\Events;

use App\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;    //events will be queued by default , better for production 
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow; //broadcast events immediately without being queued. just for dev.

class NewComment implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //who will receive this information, we will use public channel for our case
        //this channel will be subscriped on it in client side to see updates
        //make it dynamic , channel for each single post ("post.id")
        return new Channel('post.'.$this->comment->post->id);
    }

    public function broadcastWith()
    {
        //payload will be broadcasted , by default, any public props. will be passed
        return [
            'body'=> $this->comment->body,
            'created_at'=> $this->comment->created_at->toFormattedDateString(),
            'user'=> [
                'id'=> $this->comment->user_id,
                'name'=> $this->comment->user->name,
                'avatar'=> 'http://placeimg.com/80/80', //hard-coded just for test,
            ]
        ];
    }
}
