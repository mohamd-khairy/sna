<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendPaymentEmailNotification extends Notification
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
        $app_link = '<div style="text-align:center"><a href="https://drive.google.com/file/d/15P5nMQUG75slBQU9rcFf7sG1GhXD2Yva/view?usp=sharing" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >weekly schedules</a><br><br></div>';

        // $email_content = SystemEmail::find(5);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 5)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 5)->first();
        }

        $subject = config('app.name') . ': Successful Payment - ' . $this->user->program ;
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
            $subject = str_replace("{program_name}", $this->user->program, $subject);
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{program_name}", $this->user->program, $content);
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("<p>{weekly_schedules_link}</p>", $app_link, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('The International Digital University (IDU) team would like to send you warm greetings and welcome as a part of IDU family.')
            // ->line('This is to confirm that your payment has been successfully received for '. $this->user->program.' programme and you are now fully registered')
            // ->line(' We are thrilled to be a part of your coming experience of an exciting educational journey of discovery and passion for the ancient Egyptian life from all aspects. We aim to make it a useful and enjoyable experience, and we hope to have your continuous feedback.')
            // ->line('The programme teaching starts on Friday, 15th of January. Please find attached the weekly schedules for both live theoretical lectures and live practical tutorials. Please do your best to attend and interact with the professors and colleagues, but, if you can’t make it, sessions will be recorded and uploaded to IDU platform for reference at your convenience.')
            // ->line('You will be soon enrolled to the relevant courses so that you can access course materials.')
            // ->line('Welcome on board !')
            // ->line('Best wishes,')
            // ->action('weekly schedules' , 'https://drive.google.com/file/d/15P5nMQUG75slBQU9rcFf7sG1GhXD2Yva/view?usp=sharing')
            // ->line('IDU Student Support Office')
            // ->line('Attachment Link: ')
            // ->line('https://drive.google.com/file/d/15P5nMQUG75slBQU9rcFf7sG1GhXD2Yva/view?usp=sharing')
            ->salutation(' ');
    }
}
