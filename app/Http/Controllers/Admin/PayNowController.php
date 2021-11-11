<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Models\Payment;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class PayNowController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('pay_now_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $randomNumber = rand(1000,99999).time();
        $lecture_id =  $request->input('lecture_id');
        if(Auth::user()->roles->first()->id == 7 && !empty($lecture_id) ){
            $lecture = Lecture::where('id',$lecture_id)->get()->toArray();
            $installment_amount = 735;
            $currency = "EGP";
            if(Auth::user()->country == Auth::user()->auto_country && Auth::user()->country=="EG"){
                $installment_amount = 525;
                $currency = "EGP";
            }
            $payment_type = 2;
        }else{
            $payment_type = 1;
            $currency = "EGP";
            if(Auth::user()->installment == 0){
                $installment_amount = 25700;
            }else{
                $installment_amount = Auth::user()->installment_amount ;
            }
        }


        $curl = curl_init();
        $myparamter =new \stdClass();
        $myparamter->apiOperation ="CREATE_CHECKOUT_SESSION" ;
        $myparamter->interaction = new \stdClass();
        $myparamter->interaction->operation = "PURCHASE" ;
        $myparamter->interaction->returnUrl  = route('admin.payments.add-store');
        $myparamter->interaction->displayControl =new \stdClass();
        $myparamter->interaction->displayControl->billingAddress ="HIDE";
        $myparamter->interaction->displayControl->orderSummary="HIDE";
        $myparamter->order= new \stdClass();
        $myparamter->order->amount=$installment_amount;
        $myparamter->order->id = $randomNumber ;
        $myparamter->order->currency = $currency;
        $myparamter->order->description="payment for joining IDU online diploma";
       // $myparamter->order->reference  = "TEST-SUCCEED";
        $myparamter->transaction= new \stdClass();
        $myparamter->transaction->acquirer= new \stdClass();
        //dd($payment->id);
        $myparamter->transaction->acquirer->transactionId =$randomNumber;
        $myparamter= json_encode($myparamter);

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://cibpaynow.gateway.mastercard.com/api/rest/version/57/merchant/CIB701026/session",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>$myparamter,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Basic bWVyY2hhbnQuQ0lCNzAxMDI2OmRmYjhhYzQzMWU5NzMwZmU0M2VkNzE1YjAxZTkwMzVl",
                "Content-Type: application/json",
                "Cookie: TS01f8f5b8=0163461fddc333f30119241a9c2a9b0838e841d8322a424dc9cc0666349a2d81f6a9aac0a1c797d59fdd202391da50b51685c0a216"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        if (isset($response->successIndicator)){
    //       dd($response->successIndicator);
            $payment = Payment::updateOrCreate(['user_id'=> Auth::user()->id,'status'=> 'canceled'],
                ['transaction'=>$randomNumber,'sessionIndicator'=>$response->successIndicator,'amount'=>$installment_amount ,'payment_type'=>$payment_type,'lecture_id'=>$lecture_id]);

            // Insert Log
            $log_message = "The user: ".Auth::user()->name." paid ".$installment_amount;
            $this->save_log(Auth::user()->id,$log_message);
            // End

        }else{

        }

        //print_r($response->session->id) ;
        return view('admin.payNows.index',compact('response'));
    }
}
