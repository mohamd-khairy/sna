<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendSecondAfterPaymentEmailNotification extends Notification
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
        $app_link = '<div style="text-align:center"><a href="https://admission.iduni.net/unnamed.png" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >Click Here to Check the Announcement of Dr. Zahi Hawass Opening Session</a><br><br></div>';

        // $email_content = SystemEmail::find(7);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 7)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 7)->first();
        }

        $subject = 'IDU: Egyptology with Dr. Zahi Hawass’ Opening Lecture';
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("<p>{opening_session_link}</p>", $app_link, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('‘Egyptology with Dr. Zahi Hawass’ Professional Diploma starts on Friday, 15th of January, 2021. The opening lecture will be conducted by Dr. Zahi Hawass at 1:30 - 2:30 pm Cairo time (GMT+2) and will be entitled ‘Pyramids, Mummies and Tutankhamun’ . The lecture will be live and available for IDU students. Instructions on how to access the IDU platform, opening session and rest of the lectures will be sent to you soon by email.')
            // ->line('The opening lecture will be followed by other programme lectures and tutorials according to the previously communicated schedules.')
            // ->line(' Stay tuned, the journey of excitement starts soon!')
            // ->action('Click Here to Check the Announcement of Dr. Zahi Hawass Opening Session' , 'https://admission.iduni.net/unnamed.png ')

            // ->line('Best wishes,')
            // ->line('IDU Student Support Office')
            ->salutation(' ');
    }
}
