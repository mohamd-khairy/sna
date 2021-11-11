<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class VisitorEGRegisteration extends Notification
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
        // $email_content = SystemEmail::find(10);
        $email_content = SystemEmail::where('type', '=', 3)->where('name_id', '=', 10)
                                ->where('lecture_id', '=', 1)->first();
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 10)->first();
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
            // ->line('This is to inform you that your application to attend ‘How the great Pyramid oh KHUFU was built’ lecture By Dr. Zahi Hawass at the International Digital University (IDU) is being processed and a reply will be sent to you as soon as possible.')
            // ->line('Once approved, you will be sent an email with relevant instructions.')
            // // ->line('Please note that, Due to a high number of applications, replies can be later than expected.')

            // ->action(config('app.name'), config('app.url'))
            // ->line('Best wishes,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}