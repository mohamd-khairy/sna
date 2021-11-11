<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SendWithdrawalEmailNotification extends Notification
{
    use Queueable;

    public function __construct($user,$reason)
    {
        $this->user = $user;
        $this->reason = $reason;
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
            ->subject(config('app.name') . ': Application Withdrawal - ' . $this->user->program )
            ->greeting('Dear ' . $this->user->name .',')
            ->line('Kindly be informed that your request for withdrawal from '. $this->user->program.'has been accepted. You are welcomed to rejoin IDU anytime in the future.  ' )
            //->line('This decision has been made based on the following reasons;')
           // ->line(' '.$this->reason )
            //->line('You are very much welcomed to explore other available programmes at IDU,')
            //->action(config('app.name'), route('admin.users.show', ['user' => $this->user->id]))
            ->line('Thank you')
            ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
