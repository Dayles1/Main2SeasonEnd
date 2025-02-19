<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;

class NewCommentNotification extends Notification
{
    protected $comment;

    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'type' => 'comment',
            'message' => $this->comment->user_name . ' commented on your post.',
            'post_id' => $this->comment->commentable_id,
        ];
    }
}
