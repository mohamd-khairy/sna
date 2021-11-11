<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\VisitorILRegisteration;
use App\Notifications\VisitorEGRegisteration;
use App\Notifications\VisitorWelcomeEmail;
use App\Notifications\SendApprovelEmailNotification;

class UserVerificationController extends Controller
{
    public function approve($token)
    {
        $user = User::where('verification_token', $token)->first();
        abort_if(!$user, 404);

        $user_roles_arr = $user->roles->toArray();
        $user_role = $user_roles_arr[0]['id'];
        $user_nationality = $user->nationality;

        $user->verified           = 1;
        $user->verified_at        = Carbon::now()->format(config('panel.date_format') . ' ' . config('panel.time_format'));
      //  $user->verification_token = null;
        $user->status = 'Unchecked';
        $user->save();
        $log_message = "";
        if($user_role==7){
            if($user_nationality=="IL"){
                // Insert Log
                $log_message = "The user: ".$user->name." verified his account and the IL email has been sent.";
                $this->save_log($user->id,$log_message);
                
                $users = User::where('id',$user->id)->get();
                Notification::send($users, new VisitorILRegisteration($user));
                return redirect()->route('login')->with('message', trans('global.emailVerificationEG'));
            }elseif ($user_nationality=="EG") {
                // Insert Log
                $log_message = "The user: ".$user->name." verified his account and the egyptian email has been sent.";
                $this->save_log($user->id,$log_message);

                $users = User::where('id',$user->id)->get();
                Notification::send($users, new VisitorEGRegisteration($user));
                return redirect()->route('login')->with('message', trans('global.emailVerificationEG'));
            }else{
                // Insert Log
                $log_message = "The user: ".$user->name." verified his account and the automatic approval email has been sent.";
                $this->save_log($user->id,$log_message);

                $users = User::where('id',$user->id)->get();
                $user->update(['status'=> 'Approve']);
                Notification::send($users, new VisitorWelcomeEmail($user));
                // return redirect()->route('login')->with('message', trans('global.emailVerificationSuccess'));
                return redirect()->route('login')->with('message', trans('global.emailVerificationEG'));
            }
        }else{
            // Insert Log
            $log_message = "The user: ".$user->name." verified his account and the approval email has been sent.";
            $this->save_log($user->id,$log_message);
            
            // $users = User::where('id',$user->id)->get();
            // Notification::send($users, new SendApprovelEmailNotification($user));
            return redirect()->route('login')->with('message', trans('global.emailVerificationEG'));
        }

        


    }
}
