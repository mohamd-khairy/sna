<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SendApprovelStatusEmailNotification extends Notification
{
    use Queueable;

    public function __construct($user,$reason,$status)
    {
        $this->user = $user;
        $this->reason = $reason;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return $this->getMessage();
    }

    public function getMessage()
    {
        return (new MailMessage)
            ->subject(config('app.name') . ': user ' . $this->user->name . ' is  ' . $this->status)
            ->greeting('Dear CEO,')
            ->line('Kindly be informed that this application to join the '. $this->user->program->name.' programme has been '.$this->status )
            ->line('by '.Auth::user()->name .' ,at '. date('Y-m-d H:i:s'))
            ->line('because '.$this->reason )
            ->action(config('app.name'), route('admin.users.show', ['user' => $this->user->id]))
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
