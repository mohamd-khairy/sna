<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\HtmlString;
use App\Models\SystemEmail;

class VerifyUserNotification extends Notification
{
    use Queueable;

    private $user = null;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $verification_link = '<div style="text-align:center"><a href="'.route('userVerification', $this->user->verification_token).'" rel="noopener" style="box-sizing:border-box;font-family:-apple-system,BlinkMacSystemFont,Roboto,Helvetica,Arial,sans-serif;border-radius:4px;color:#fff;display:inline-block;overflow:hidden;text-decoration:none;background-color:#2d3748;border-bottom:8px solid #2d3748;border-left:18px solid #2d3748;border-right:18px solid #2d3748;border-top:8px solid #2d3748;font-size: 13px;" target="_blank" >Click here to verify</a><br><br></div>';
        if(!empty($this->user->program->id)){
            $email_content = SystemEmail::where('type', '=', 2)->where('name_id', '=', 2)
                                ->where('program_id', '=', $this->user->program->id)->first();
        }
        if(empty($email_content)){
            $email_content = SystemEmail::where('type', '=', 1)->where('name_id', '=', 2)->first();
        }
        // $email_content = SystemEmail::find(2);
        $subject = config('app.name') . ' Email Verification ';
        $content = "";
        if(!empty($email_content->subject)){
            $subject = $email_content->subject;
        }
        if(!empty($email_content->message)){
            $content = $email_content->message;
            $content = str_replace("{user_name}", $this->user->name, $content);
            $content = str_replace("<p>{verification_link}</p>", $verification_link, $content);
        }

        return (new MailMessage)
            ->subject(config('app.name') . ' Email Verification ')
            ->line(new HtmlString($content))
            ->greeting(' ')
            // ->greeting('Dear ' . $this->user->name .',')
            // ->line('Thank You for Applying to the International Digital University (IDU).')
            // ->line('Please Click The below button to verify your email address.')
            // ->action(trans('global.clickHereToVerify'), route('userVerification', $this->user->verification_token))
            // ->line('Kindly note that you won’t be able to access your registration account on IDU unless your application is approved. An email will be sent to you once your application is approved.')
            // ->line(trans('global.thankYouForUsingOurApplication'))
            ->salutation(' ')
            ;
    }

    public function toArray($notifiable)
    {
        return [];
    }
}
