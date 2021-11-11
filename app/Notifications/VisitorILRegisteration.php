<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class VisitorILRegisteration extends Notification
{
    use Queueable;

    public function __construct($user)
    {
        $this->user = $user;
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
    	// $email_content = SystemEmail::find(11);
        $email_content = SystemEmail::where('type', '=', 3)->where('name_id', '=', 11)
                                ->where('lecture_id', '=', 1)->first();
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 11)->first();
        }

        $subject = config('app.name') . ':  Registration Completion';
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
            $subject = str_replace("{program_name}", $this->user->program, $subject);
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{user_name}", $this->user->name, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('Thank you for submitting your application to attend ‘How the great Pyramid oh KHUFU was built’ lecture By Dr. Zahi Hawass at the International Digital University. Once your application is approved, you will be notified by email.')
            // ->line('Please note that due to the high number of applications, replies can be later than expected.')

            // ->action(config('app.name'), config('app.url'))
            // ->line('Best wishes,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}