<?php
 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Omnipay\Omnipay;
use App\Models\Payment;
use App\Models\User;
use App\Models\Lecture;
use Illuminate\Support\Facades\Auth;
use App\Notifications\SendPaymentEmailNotification;
use Illuminate\Support\Facades\Notification;
 
class PaypalController extends Controller
{
 
    public $gateway;
 
    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(env('PAYPAL_CLIENT_ID'));
        $this->gateway->setSecret(env('PAYPAL_CLIENT_SECRET'));
        // $this->gateway->setClientId('AZ0VdYVHpZgQw8hbQnQSmJk8kwj0OtLE-qlM4Eu7nwubttPrqtlVkAjFTvG6_xB-Mb-nCURuL2wTQpGx');
        // $this->gateway->setSecret('EA6tYyc8g1YoSNk8YXKbY4RqO0jJAr-_7KHrXYo1LssXCqqXgqmLEIz-IuC1EpowciwPNNUX-mguTSym');
        $this->gateway->setTestMode(false); //set it to 'false' when go live
    }
 
    public function index()
    {
        // $users = User::find(Auth::user()->id);
        // // print_r($users);die;
        // Notification::send($users, new SendPaymentEmailNotification($users));
        // echo env('PAYPAL_CLIENT_SECRET','');
        die("---");
        // return view('admin.paypal.payment');
    }
 
    public function charge(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $lecture_id =  $request->input('lecture_id');
        
        if($user->roles->first()->id == 7 && !empty($lecture_id) ){
            $lecture = Lecture::where('id',$lecture_id)->get()->toArray();
            $amount = intval($lecture[0]['price_forign']);
            if($user->country == $user->auto_country && $user->country=="EG"){
                $amount = intval($lecture[0]['price_egyption']);
            }
        }else{
            if($user->installment == 0){
                $amount = 1680;
            }else{
                $amount = 880;
            }
            // echo $amount;die;
        }
        
        if($request->input('submit'))
        {
            try {
                $response = $this->gateway->purchase(array(
                    // 'amount' => $request->input('amount'),
                    // 'amount' => 1633,
                    'amount' => $amount,
                    'currency' => env('PAYPAL_CURRENCY'),
                    'returnUrl' => url('admin/paymentsuccess'),
                    'cancelUrl' => url('admin/paymenterror'),
                ))->send();
          
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch(Exception $e) {
                return $e->getMessage();
            }
        }
    }
 
    public function payment_success(Request $request)
    {
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID'))
        {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();
         
            if ($response->isSuccessful())
            {
                // The customer has successfully paid.
                $arr_body = $response->getData();
         
                // Insert transaction data into the database
                $isPaymentExist = Payment::where('transaction', $arr_body['id'])->first();
         
                if(!$isPaymentExist)
                {
                    $user = User::find(Auth::user()->id);
                    if($user->roles->first()->id == 7){
                        $payment_type = 2;
                    }else{
                        $payment_type = 1;
                    }

                    $payment = new Payment;
                    $payment->transaction = $arr_body['id'];
                    $payment->sessionIndicator = 'paypal';
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    if($arr_body['state'] == "approved"){
                        $payment->status = "Captured - Paypal";
                    }else{
                        $payment->status = $arr_body['state'];
                    }
                    $payment->user_id = Auth::user()->id;
                    $payment->currency = 'USD';
                    $payment->fullresponse = json_encode($arr_body);
                    $payment->payment_type = $payment_type;
                    $payment->lecture_id = 1;
                    // $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->save();

                    // Insert Log
                    $log_message = "The user: ".Auth::user()->name." paid ".$payment->amount." by paypal";
                    $this->save_log(Auth::user()->id,$log_message);
                    // End

                    // Send notification
                    $users = User::find(Auth::user()->id);
                    Notification::send($users, new SendPaymentEmailNotification($users));
                }
                $updated = true ;
                // return "Payment is successful. Your transaction id is: ". $arr_body['id'];
                return redirect()->route('admin.home', compact('updated'));
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }
 
    public function payment_error()
    {
        return 'User is canceled the payment.';
    }
 
}