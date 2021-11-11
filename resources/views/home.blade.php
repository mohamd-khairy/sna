@extends('layouts.admin')
@section('content')
    <style media="screen">
        /* Make the image carousel fully responsive */
        .carousel-inner img {
            width: 100%;
            height: 100%;
        }

        .whole-page {}

        .par-title {
            text-align: center;
            color: #0c2043;
            font-size: 2rem;
            font-weight: bolder;
            padding: 1% 0%;
        }

        .lead {
            text-align: justify;
            line-height: 2;
        }

        .jumbotron {
            background-color: #fafafa;
        }

        .section-programs h3 {
            color: #0D2944;
            text-align: center;
            margin-top: 5%;
            margin-bottom: 2%;
            color: #0c2043;
            font-size: 1.75rem;
            font-weight: bolder;
            padding: 1% 0%;
        }

        .prog-title {
            margin-bottom: .75rem;
            font-size: 1.5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        .cards-bg {
            background-color: #FFFFFF;
        }

        .card-body {}

        .card-text {}

        .card {}

        .card-img {
            /* background-image: url(https://drive.google.com/uc?export=view&id=1STyCKsglyvMOwVlhrz3MB7awwRiok2sG); */
            min-width: 100%;
            min-height: 300px;
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 111111;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.5);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            /* position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%); */
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .carousel-control-next.carousel-control-next-icon,
        .carousel-control-prev.carousel-control-prev-icon,
        #prev-arrow,
        #next-arrow {
            color: white !important;
            display: inline-block !important;
            width: 20px !important;
            height: 20px !important;
            background: left top !important;
            font-size: 24px !important;
            font-weight: bolder;
            /* background-color: white; */
            /* background: no-repeat 50%/100% 100%; */
        }
    </style>
@php
$user = Auth::user();
$user_roles_arr = $user->roles->toArray();
@endphp
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                   IDU
                </div>
                <section class="  card-body jumbotron text-center">
                    <div class="container-fluid">
                        <!-- <h2 class="par-title">IDU Programmes</h2> -->
                        <p class="lead"> The International Digital University (IDU) provides both undergraduate and post-graduate programmes. IDU students have the chance to choose from a wide range of programs in different disciplines. They have the ability to
                            access all lectures and teaching materials online through specialized and professional platforms and softwares that will enable them to attend lectures and interactive course activities at their homes.
                    </div>
                </section>

            </div>
        </div>
    </div>
    <div class="jumbotron text-center">


        @if(session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @can('Send_Email_Unpaid')
            <button id="unpaid-email" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"  class="btn btn-success col-lg-4  " style="font-size:  20px">
                Send Email for Unpaid applicants
            </button>
        @endcan

        @can('pay_now_access')
                @php
                    $payed = 0;
                    $total_payments = 0;
                    $payment_status = 0;
                    foreach(Auth::user()->userPayments as $payment){
                        if($payment->status == 'Captured' || $payment->status == 'approved'){
                            $total_payments++;
                        }
                    }
                @endphp
            @foreach(Auth::user()->userPayments as $payment)
                @if( ($payment->status == 'Captured' || $payment->status == 'approved' ) && ($payment->amount== 25700 || $payment->amount== 1680 || $total_payments>1 ) )
                        @php
                            $payed = 1;
                        @endphp
                @endif
            @endforeach 
                @if(app('request')->input('updated')!=false||$payed ==1)
                    <p  class="  " style="font-size:  40px">
                        <img src="{{ asset('IDU-LOGO2-02.png') }}" class="col-lg-2 col-sm-2">
                        Your payment has been successful.
                    </p>
                  @else
                    <!-- KG Start -->

                    <div>
                        <h1>Pay Now</h1>
                        <p class="lead pay-text">You can pay using one of the following payment methods:</p>
                    </div>
                     <ul class="tabs-nav">
                        <li class="tab-active"><a href="#tab-1" rel="nofollow">Credit Card</a></li>
                        <li class=""><a href="#tab-2" rel="nofollow">Paypal</a></li>
                        <li class=""><a href="#tab-3" rel="nofollow">Bank Transfer</a></li>
                    </ul>
                    <div class="tabs-stage">

                        @if($user_roles_arr[0]['id']!=7 )
                            @php
                             if($user->installment == 0){
                                $installment_amount = 25000;
                                $installment_amount_dollar = 1600;
                            }else{
                                $installment_amount = $user->installment_amount ;
                                $installment_amount_dollar = 800;
                            }
                            @endphp
                        <div id="tab-1" style="display: block;">
                            <br>
                            <p class="alert alert-info offset-lg-4 col-lg-4" role="alert">
                                IDU Fees: {{number_format($installment_amount,2)}} EGP <br>
                                E-Payment Fees: 700.00 EGP <br>
                                -------------------------- <br>
                                Total Fees: {{number_format(($installment_amount+700),2)}} EGP
                            </p>
                            <form action="{{ url('admin/pay-nows') }}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" name="submit" value="Pay Using Credit Card" class="btn btn-success col-lg-4 payment-buttons">
                            </form>

                            <p></p>
                        </div>
                        <div id="tab-2" style="display: none;">
                            <br>
                            <p class="alert alert-info offset-lg-4 col-lg-4" role="alert">
                                IDU Fees: {{number_format($installment_amount_dollar,2)}} USD <br>
                                E-Payment Fees: 80.00 USD <br>
                                -------------------------- <br>
                                Total Fees: {{number_format(($installment_amount_dollar+80),2)}} USD<br>
                                or equivalent value in GBP or Euro
                            </p>
                            <form action="{{ url('admin/charge') }}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" name="submit" value="Pay Using Paypal" class="btn btn-success col-lg-4 payment-buttons">
                            </form>
                            <p></p>
                        </div>
                        @endif





                        @if($user_roles_arr[0]['id']==7 )
                            @if(isset($all_lectures[0]))
                                @php
                                $lecture_price = 800;
                                $lecture_paymentfees = 40 ;
                                if($user->country == $user->auto_country && $user->country=="EG"){
                                    $lecture_price = 500;
                                    $lecture_paymentfees = 25 ;
                                }
                                @endphp
                                <div id="tab-1" style="display: block;">
                                    <br>
                                    <p class="alert alert-info offset-lg-4 col-lg-4" role="alert">
                                        <span><b>{{$all_lectures[0]['name']}}</b></span><br>
                                        <span>Lecture Fees: {{$lecture_price}} EGP</span> <br>
                                        <span>E-Payment Fees: {{$lecture_paymentfees}} EGP</span> <br>
                                        -------------------------- <br>
                                        Total Fees: {{$lecture_price+$lecture_paymentfees}} EGP<br>
                                        or equivalent value in USD or Euro
                                    </p>
                                    <form action="{{ url('admin/pay-nows') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="lecture_id" value="{{$all_lectures[0]['id']}}">
                                        <input type="submit" name="submit" value="Pay Using Credit Card" class="btn btn-success col-lg-4 payment-buttons">
                                    </form>
                                    <p></p>
                                </div>
                                <div id="tab-2" style="display: none;">
                                    <br>
                                    <p class="alert alert-info offset-lg-4 col-lg-4" role="alert">
                                        <span><b>{{$all_lectures[0]['name']}}</b></span><br>
                                        <span>Lecture Fees: {{$lecture_price}} EGP</span> <br>
                                        <span>E-Payment Fees: {{$lecture_paymentfees}} EGP</span> <br>
                                        -------------------------- <br>
                                        Total Fees: {{$lecture_price+$lecture_paymentfees}} EGP<br>
                                        or equivalent value in USD or Euro
                                    </p>
                                    <form action="{{ url('admin/charge') }}" method="post">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="lecture_id" value="{{$all_lectures[0]['id']}}">
                                        <input type="submit" name="submit" value="Pay Using Paypal" class="btn btn-success col-lg-4 payment-buttons">
                                    </form>
                                    <p></p>
                                </div>

                            @else
                                 <div id="tab-1" style="display: block;">
                                   <h1>Sorry we haven't lecture to join now , please keep updated we will contact you soon</h1>
                                 </div>
                            @endif
                        @endif


                        <div id="tab-3" style="display: none;">
                            <br>
                            <p class="alert alert-info offset-lg-4 col-lg-4" role="alert">
                                <b>IDU fees:</b> {{number_format($installment_amount_dollar,2)}} USD plus<br>
                                <b>Transfer fees:</b> according to payer’s bank.<br>
                                i.e. IDU fees are {{number_format($installment_amount_dollar,2)}} USD excluding transfer fees<br>
                                <br>
                                <b> SMART FOR ADVANCED EDUCATION</b><br>
                                <b>Egyptian Pound</b><br>
                                EGP account Number 100043755867<br>
                                EGP IBAN EG690010014900000100043755867<br>
                                <br>
                                <b>US Dollars</b><br>
                                USD Account Number 100043755875<br>
                                USD IBAN EG470010014900000100043755875<br>
                                <br>
                                <b>Euro</b><br>
                                Euro account number 100043755883<br>
                                Euro IBAN EG250010014900000100043755883<br>
                                <br>
                                <b>British pound</b><br>
                                GBP account number 100043755891<br>
                                GBP IBAN EG03001001490000043755891<br>
                                <br>
                                Swift code: CIBEEGCX149<br>
                                Americana Plaza Branch<br>
                                Commercial International Bank (CIB)<br>
                                <br>
                                Address: Americana Plaza Branch, Commercial International Bank (CIB) Egypt, Sheikh Zayed City, Giza, Egypt. <br>
                                <br>
                                After the successful payment by bank transfer, please send a valid document as proof for this transaction to <a href="mailto:administration@iduni.net">administration@iduni.net</a>.<br>
                            </p>
                        </div>
                    </div>
                    @php
                    if(false){
                    @endphp
                    <div>
                        <a href="#" class="btn btn-success col-lg-4  " id="main-payment-btn" style="font-size:  40px">
                            <img src="{{ asset('IDU-LOGO2-02.png') }}"    style="width:  80px">
                            {{ trans('cruds.payNow.title') }}
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="payment-buttons paypal-payment">
                                <form action="{{ url('admin/charge') }}" method="post">
                                    <!-- <input type="text" name="amount" /> -->
                                    {{ csrf_field() }}
                                    <input type="submit" name="submit" value="Pay Using Paypal" class="btn btn-success col-lg-4 payment-buttons">
                                </form>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <form action="{{ url('admin/pay-nows') }}" method="post">
                                {{ csrf_field() }}
                                <input type="submit" name="submit" value="Pay Using Credit Card" class="btn btn-success col-lg-4 payment-buttons">
                            </form>
                        </div>
                    </div>
                    @php
                    }
                    @endphp
                    <!-- KG End -->

                @endif
        @endcan
    </div>
    <section class="section-programs">
        <h3 style="">
            Available Programmes
        </h3>
        </br>

        <div class="row">


            <div class="col-lg-6">
                <div class="card mb-6 mt-auto shadow-sm">
                    <div class="card-img" style="background-image: url(https://drive.google.com/uc?export=view&id=1STyCKsglyvMOwVlhrz3MB7awwRiok2sG);"></div>
                    <div class="card-body">
                        <h4 class="card-title prog-title">Bio Health Informatics</h4>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group my-auto">
                                <button type="button" class="btn btn-md mr-4 btn-primary" onclick="window.location.href='https://www.iduni.net/local/staticpage/view.php?page=BioandHealthInformatics-Prog';">Program Details</button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-6 mt-auto shadow-sm">
                    <div class="card-img" style="background-image: url(https://drive.google.com/uc?export=view&id=1Xg_5ad9uCHufH0bN76pKP2EYmKnQr_xE);"></div>
                    <div class="card-body">
                        <h4 class="card-title prog-title">Egyptology by Dr. Zahi Hawass</h4>
                        <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group my-auto">
                                <button type="button" class="btn btn-md mr-4 btn-primary" onclick="window.location.href='https://www.iduni.net/local/staticpage/view.php?page=Egyptology-Prog';">Program Details</button>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-programs">
        <h3> Coming Soon </h3>
        </br>
        <div id="demo" class="carousel slide" data-ride="carousel">

            <!-- Indicators -->
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://drive.google.com/uc?export=view&id=1CSFUZa3jwqui7Qq2W4bvRhgtWaHvpCh-" alt="Faculty of Management">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=1Lu63RzaTFMYym5kBgYMl1dV-lraMvMnB" alt="Faculty of Computers and Artificial Intelligence" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=1y7ckaiGZGP1YFyfA_6lL8Q22m8-pUdRj" alt="Faculty of Law" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=1q-jpx6k8R7vneGnIvNR_EO06F-xb8jwK" alt="Faculty of Engineering" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=1ZV7bx49tEB3uzWPfpUou_d-6p0Fx0P0u" alt="Faculty of Cultural Heritage" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=1pDXcA_S8TD4gZhHE3Ws9tic28M7uayjf" alt="Faculty of Mass Communication" width="1100" height="500">
                </div>
                <div class="carousel-item">
                    <img src="https://drive.google.com/uc?export=view&id=17YDBCoGe1gFyHF_rdcuO0O2zZUCdR1LB" alt="Faculty of Psychology" width="1100" height="500">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon" id="prev-arrow"> &#60 </span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon" id="next-arrow"> &#62 </span>
            </a>
        </div>


    </section>
</div>
@endsection
@section('scripts')
@parent
<script>
    $('#unpaid-email').click(function(){
        $('#unpaid-email').attr('disabled',true);
    if (confirm('{{ trans('global.areYouSure') }}')) {
        window.location.href ="{{ route("admin.unpaid.send") }}"
    }
    })
</script>
@endsection
