<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class VisitorWelcomeEmail extends Notification
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
        // $email_content = SystemEmail::find(12);
        $email_content = SystemEmail::where('type', '=', 3)->where('name_id', '=', 12)
                                ->where('lecture_id', '=', 1)->first();
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 12)->first();
        }

        $subject = config('app.name') . ':  Registration Completion' ;
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("{user_email}", $this->user->email, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('Kindly be informed that your application to join ‘How the great Pyramid oh KHUFU was built’ lecture By Dr. Zahi Hawass at the International Digital University has been approved.')
            // ->line('Please follow the instructions below to ensure a successful payment process and registration completion. ')
            // ->line('1. Please login to to your IDU registration account using the following link and not the ‘login button’ on IDU website: "https://admission.iduni.net/login"')
            // ->line('            please use the credentials you used during your registration:   ')
            // ->line('            - Username: '.$this->user->email )
            // ->line('            - Password: The one you created for your application.')
            // ->line('2. Click on  "Pay Now".  ')
            // ->line('3. Fill in and submit the required information.')
            // ->line('After successful payment, a confirmation email will be sent to you.')
            // ->line('We are delighted to have you as a part of IDU family, welcome aboard!')
            // ->line('Best wishes,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}