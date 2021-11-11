<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendDisApprovelEmailNotification extends Notification
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
        // $email_content = SystemEmail::find(3);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 3)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 3)->first();
        }

        $subject = config('app.name') . ': Your Application to ' . $this->user->program->name;
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
            $subject = str_replace("{program_name}", $this->user->program->name, $subject);
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{program_name}", $this->user->program->name, $content);
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("{reasons}", $this->reason, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('We regret to inform you that after very careful consideration, your application to join the '. $this->user->program.' programme has not been successful.  ' )
            // ->line('This decision has been made based on the following reasons;')
            // ->line(' '.$this->reason )
            // ->line('You are very much welcomed to explore other available programmes at IDU,')
            // //->action(config('app.name'), route('admin.users.show', ['user' => $this->user->id]))
            // ->line('Thank you')
            // ->line(config('app.name') . ' Team')
            ->salutation(' ')
            ;
    }
}
