<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendUnPaidEmailNotification extends Notification
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
        // $email_content = SystemEmail::find(8);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 8)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 8)->first();
        }

        $subject = config('app.name') . ': Reminder to fulfil the fees of '. $this->user->program;
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
            $subject = str_replace("{program_name}", $this->user->program, $subject);
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{program_name}", $this->user->program, $content);
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("{user_email}", $this->user->email, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('This is a reminder for the required fee payment to complete your registration process and be enrolled in  '. $this->user->program.'  Please follow the instructions below:')
            // ->line('1. Login to "https://admission.iduni.net/login" using the following username and password.')
            // ->line('            - Username: '.$this->user->email )
            // ->line('            - The default password if you haven\'t changed it: idu2020')
            // ->line('            It is highly recommended to change this password to a more secure one.')
            // ->line('2. Click on  "Pay Now".  ')
            // ->line('3. Fill the required payment information.')
            // ->line('4. Payment should be fulfilled by 13/1/2021.')
            // ->line('Kindly don’t hesitate to contact us on adminstration@iduni.net, if you have any issues with the payment.')
            //->action(config('app.name'), config('app.url'))
            // ->line('Best regards,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}
