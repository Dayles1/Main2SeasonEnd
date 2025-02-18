<?php


namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

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
            'message' => 'You have a new comment on your post.',
            'comment_id' => $this->comment->id,
            'user_id' => $this->comment->user_id,
        ];
    }
}
