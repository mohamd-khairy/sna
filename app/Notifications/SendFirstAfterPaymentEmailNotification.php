<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendFirstAfterPaymentEmailNotification extends Notification
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
        $app_link = '<div style="text-align:center"><a href="https://docs.google.com/forms/d/e/1FAIpQLScYbuwU87n3llDK8snbwkwTHxK4jDYNEmo3Wa3IULPL2SmhkA/viewform?usp=sf_link" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >Click Here</a></br></br></div>';

        // $email_content = SystemEmail::find(4);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 4)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 4)->first();
        }

        $subject = 'IDU: Polling of Elective Courses (1st Semester) - Egyptology Program with Dr. Zahi Hawass';
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("<p>{poll_link}</p>", $app_link, $content);
        }

        return (new MailMessage)
            ->subject($subject)
            ->greeting(' ')
            ->line(new HtmlString($content))
            // ->line('Hope this email finds you well.')
            // ->line('The Egyptology Program with Dr. Zahi Hawass provides two elective courses for the first semester. Each student should be enrolled in one of these electives. ')
            // ->line('Please visit (https://docs.google.com/forms/d/e/1FAIpQLScYbuwU87n3llDK8snbwkwTHxK4jDYNEmo3Wa3IULPL2SmhkA/viewform?usp=sf_link) for the polling form of the elective courses')
            // ->line('Kindly note that it is required to mention both courses in the form either as "1st choice" or "2nd choice". \'First Come, First Serve\' policy applies, please choose your elective course sooner rather than later, so that you can get your first choice, otherwise, you may be assigned to your second choice course due to availability limitations.')
            // ->line('You will be notified with the assigned elective course after this poll is closed. Please note that you have to fill your choices maximum by coming Thursday 14/1/2021 - 11:59 PM (GMT+2).')
            // ->action('Click Here' , 'https://docs.google.com/forms/d/e/1FAIpQLScYbuwU87n3llDK8snbwkwTHxK4jDYNEmo3Wa3IULPL2SmhkA/viewform?usp=sf_link')
            // ->line('Best wishes,')
            // ->line('IDU Admission Office')
            ->salutation(' ');
    }
}
