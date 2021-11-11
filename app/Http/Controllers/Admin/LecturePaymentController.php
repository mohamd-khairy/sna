<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\SendFirstAfterPaymentEmailNotification;
use App\Notifications\SendPaymentEmailNotification;
use App\Notifications\SendSecondAfterPaymentEmailNotification;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\HttpFoundation\Response;

class LecturePaymentController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payments = Payment::all();

        $users = User::get();

        return view('admin.payments.index', compact('payments', 'users'));
    }

    public function show(Payment $payment)
    {
        abort_if(Gate::denies('payment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $payment->load('user', 'created_by');

        return view('admin.payments.show', compact('payment'));
    }

    public function store(Request $request)
    {
        //dd($request->resultIndicator);
        $updated = false ;
        if(isset($request->resultIndicator)){
            $updated = Payment::where('sessionIndicator',$request->resultIndicator)->update(['status'=>'Captured']);
            $users = User::find(Auth::user()->id);
            Notification::send($users, new SendPaymentEmailNotification($users));
            Notification::send($users, new SendFirstAfterPaymentEmailNotification($users));
            Notification::send($users, new SendSecondAfterPaymentEmailNotification($users));
        }
        return redirect()->route('admin.home', compact('updated'));
    }

    public function cancel()
    {
       $lasttransaction =  Payment::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->first();
      // dd($lasttransaction->toArray());
       // $lasttransaction->update(['status'=>'canceled']);
        return redirect()->route('admin.home');
    }

    public function error(Request $request)
    {
        $lasttransaction =  Payment::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->first();
        // dd($lasttransaction->toArray());
        $lasttransaction->update(['status'=> json_encode($request->all())->toString()]);
        return redirect()->route('admin.home');
    }
}
