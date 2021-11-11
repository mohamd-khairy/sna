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

            @can('pay_now_access')
                <p class="btn btn-success  " style="font-size:  40px">
                    <img src="{{ asset('IDU-LOGO2-02.png') }}" class="col-lg-2">
                    {{ trans('cruds.payNow.title') }}
                </p>
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



    <script src="https://cibpaynow.gateway.mastercard.com/checkout/version/57/checkout.js"
            data-error="{{route('admin.payments.error')}}"
            data-cancel="{{route('admin.payments.cancel')}}">
    </script>

    <script type="text/javascript">
        console.log("{{$response->session->id }}");
   /*     function errorCallback(error) {
            console.log(JSON.stringify(error));
            window.location.href = "/";
        }
        function cancelCallback() {
            window.location.href = "";
        } */

        Checkout.configure({
            session: {
                id: '{{$response->session->id }}'
            },
            interaction: {
                merchant: {
                    name: 'IDUNI',
                }
            }
        });
    </script>

    <script type="text/javascript">
        window.onload = Checkout.showLightbox();
    </script>

@endsection
