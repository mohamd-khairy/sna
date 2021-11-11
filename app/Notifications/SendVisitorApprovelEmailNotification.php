<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendVisitorApprovelEmailNotification extends Notification
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
        $app_link = '<div style="text-align:center"><a href="'.config('app.url').'" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >'.config('app.name').'</a><br><br></div>';

        // $email_content = SystemEmail::find(9);
        $email_content = SystemEmail::where('type', '=', 3)->where('name_id', '=', 9)
                                ->where('lecture_id', '=', 1)->first();
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 9)->first();
        }


        $subject = config('app.name') . ':  Registration Completion - ' . $this->user->program ;
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
            $subject = str_replace("{lecture_name}", $this->user->program, $subject);
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{lecture_name}", $this->user->program, $content);
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("{user_email}", $this->user->email, $content);
            $content = str_replace("<p>{app_link}</p>", $app_link, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('Kindly be informed that your application to join the '. $this->user->program.' lecture at The International Digital University (IDU) has been approved.')
            // ->line('Please follow the instructions below to ensure a successful payment process and complete the registration process; ')
            // ->line('1. Login to your registration account using this link "https://admission.iduni.net/login" and not the "Login button" on IDU website:')
            // ->line('            These are your credentials:   ')
            // ->line('            - Username: '.$this->user->email )
            // ->line('            - The password you have added in your application form.')
            // ->line('2. Click on  "Pay Now".  ')
            // ->line('3. Fill the required payment information.')
            // // ->line('4. Payment should be fulfilled by 13/1/2021.')
            // ->line('After completing the payment process, an email will be sent to you for confirmation.')
            // ->line('We are delighted to have you as a part of IDU family, welcome on board! ')
            // ->line($this->user->program=='Egyptology by Dr. Zahi Hawass'?'Get ready to reveal the secrets and discover the treasures of the Ancient Egyptians\' History.':'')
            // ->action(config('app.name'), config('app.url'))
            // ->line('Best regards,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}
