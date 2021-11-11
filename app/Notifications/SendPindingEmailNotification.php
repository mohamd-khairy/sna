<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class SendPindingEmailNotification extends Notification
{
    use Queueable;

    public function __construct($user,$reason,$status)
    {
        $this->user = $user;
        $this->reason = $reason;
        $this->status = $status;
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
        // $email_content = SystemEmail::find(6);
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 6)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 6)->first();
        }
        $subject = config('app.name') . ': Application Processing -  ' . $this->user->program->name;
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
            // ->line('Kindly be informed that your application has been reviewed by the Programme Leader of '.$this->user->program .' programme. It is noted that your application is missing some documents. ')
            // ->line('These are '.$this->reason.' so, kindly reply to this e-mail and include these documents as attachments. This is very important for your application file to be complete')
            // ->line('If you have any questions or you need any assistance, please e-mail us on administration@iduni.net. Or call us on (002) ……………...')
            // ->line('')
           // ->action(config('app.name'), config('app.url'))
            // ->line('Thank you')
            // ->line(config('app.name') . ' Team')
            ->salutation(' ');
    }
}
