<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Notifications\SendApprovelEmailNotification;
use App\Notifications\SendVisitorApprovelEmailNotification;
use App\Notifications\SendApprovelStatusEmailNotification;
use App\Notifications\SendDisApprovelEmailNotification;
use App\Notifications\SendPindingEmailNotification;
use App\Notifications\SendWithdrawalEmailNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class ApprovalController extends Controller
{
    public function index(Request $request)
    {
        $user = User::find($request->userID);
        $updated = $user->update(['status'=>$request->selection,'reason'=>$request->reason]);
        if($request->selection == 'Approve'){
            $updated = $user->update(['approved'=>1]);
            if($user->roles->first()->id == 7){
                // Insert Log
                $log_message = "The status for the user: ".$user->name." changed to Approved.";
                $this->save_log($user->id,$log_message);
                // End
                return $this->visitorapproval($user);
            }else{
                // Insert Log
                $log_message = "The status for the user: ".$user->name." changed to Approved.";
                $this->save_log($user->id,$log_message);
                // End
                return $this->sendapproval($user);
            }
        }elseif ($request->selection == 'Refused'){
            // Insert Log
            $log_message = "The status for the user: ".$user->name." changed to Refused.";
            $this->save_log($user->id,$log_message);
            // End
            return $this->senddisapproval($user,$request->reason,'Refused');
        }elseif ($request->selection == 'Pending'){
            // Insert Log
            $log_message = "The status for the user: ".$user->name." changed to Pending.";
            $this->save_log($user->id,$log_message);
            // End
            return $this->sendPending($user,$request->reason);
        }elseif ($request->selection == 'Withdrawal'){
            // Insert Log
            $log_message = "The status for the user: ".$user->name." changed to Withdrawal.";
            $this->save_log($user->id,$log_message);
            // End
            return $this->senddisapproval($user,$request->reason,'Withdrawal');
        }elseif ($request->selection == 'Unchecked'){
            return false ;
        }
    }

    public function sendapproval($user)
    {
        $users = User::where('id',$user->id)->get();
        Notification::send($users, new SendApprovelEmailNotification($user));
        $ceo = User::whereHas('roles', function ($q) {
            return $q->where('title', 'CEO');
        })->get();
        Notification::send($ceo, new SendApprovelStatusEmailNotification($user,$reason='','Approved'));
    }
    public function visitorapproval($user)
    {
        $users = User::where('id',$user->id)->get();
        Notification::send($users, new SendVisitorApprovelEmailNotification($user));
        $ceo = User::whereHas('roles', function ($q) {
            return $q->where('title', 'CEO');
        })->get();
        Notification::send($ceo, new SendApprovelStatusEmailNotification($user,$reason='','Approved'));
    }

    public function sendPending($user,$reason)
    {
        $users = User::where('id',$user->id)->get();
        Notification::send($users, new SendPindingEmailNotification($user,$reason,'Pending'));
        $ceo = User::whereHas('roles', function ($q) {
            return $q->where('title', 'CEO');
        })->get();
        Notification::send($ceo, new SendApprovelStatusEmailNotification($user,$reason,'Pending'));
    }
    public function senddisapproval($user,$reason,$status)
    {
        $ceo = User::whereHas('roles', function ($q) {
            return $q->where('title', 'CEO');
        })->get();
        Notification::send($ceo, new SendApprovelStatusEmailNotification($user,$reason,$status));
    }

    public function finaldisapproval(Request $request)
    {
        $user = User::find($request->userID);
        if($user->status== 'Withdrawal'){
            Notification::send($user, new SendWithdrawalEmailNotification($user,$user->reason));
        }
        elseif($user->status== 'Refused'){
            Notification::send($user, new SendDisApprovelEmailNotification($user,$user->reason));
        }
    }

    public function installment(Request $request)
    {
        $user = User::find($request->userID);
        $updated = $user->update(['installment'=>$request->installment,'installment_amount'=>$request->installment_amount]);

    }
}
