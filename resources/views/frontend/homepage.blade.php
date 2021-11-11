@extends('layouts.front',[$ContentCategory])
@section('content')

@php
$current_lang = "en";
$content_var = "content_".$current_lang;
$description_var = "description_".$current_lang;
$name_var = "name_".$current_lang;
$title_var = "title_".$current_lang;
@endphp

<!-- Start  Slider-->
<section class="header">
    <div class="slider-header owl-carousel owl-theme">
        @foreach($HomePageSliders as $k1=>$v1)
            {!! $v1->$content_var !!}
        @endforeach
    </div>
</section>
<!-- End  Slider-->
@if(!empty($new_lecture_join))
{!! $new_lecture_join->$content_var !!}
@endif

{!! $homepage_idu_vision->$content_var !!}
{!! $homepage_iduni_video->$content_var !!}
{!! $homepage_iduni_strategies->$content_var !!}

@if(!empty($homepage_egyptology_dr_zahi_snippet1))
{!! $homepage_egyptology_dr_zahi_snippet1->$content_var !!}
@endif
@if(!empty($homepage_egyptology_dr_zahi_snippet2))
{!! $homepage_egyptology_dr_zahi_snippet2->$content_var !!}
@endif


<!-- start categories-->

<!-- end categories-->

<!-- Satrt personal slider-->
<section class="personal-slider animation-element slide-left">
    <div class="container">
        <div class="row">
            <div class="title">
                <p style="color:#555555;">
                    IDU Founders
                </p>
            </div>
            <div class="owl-personal owl-carousel owl-theme">
               @foreach($Founders as $k2=>$v2)
                @if($v2->department=="IDUFounders")
                <div class="item">
                    <div class="image-c">
                        <img src="{{ $v2->image->url }}">
                    </div>
                    {!! $v2->$description_var !!}
                    <p class="overview testimonial-name">
                        <b class="text-uppercase" style="color: #555555;">{{ $v2->$name_var }}</b>
                        <span style="color: #555555;">
                            , {{ $v2->$title_var }}
                    </span>
                    </p>
                </div>
                @endif
                @endforeach

            </div>
        </div>
    </div>
</section>
<!-- End personal slider-->

<!-- start Our team-->
@if(false)
<section class="our-team animation-element slide-left">
    <div class="container">
        <div class="row">
            <div class="title">
                <p class="font-weight-bold font-size-30" style="color:#0b2a4c;">Meet our Egypology team</p>
            </div>

            <div class="grid-container">
                @foreach($Founders as $k2=>$v2)
                @if($v2->department=="EgyptologyTeam")
                <div class="card">
                    <div class="image">
                        <img src="{{ $v2->image->url }}">
                    </div>
                    <div class="card-body">
                        <div class="title">
                            <h5 style="color: #555555;"><strong>{{ $v2->$name_var }}</strong></h5>
                        </div>
                        <p class="font-size-12" style="color: #555555;">{!! strip_tags($v2->$description_var) !!}</p>
                    </div>
                </div>
                @endif
                @endforeach



            </div>
        </div>
    </div>
</section>
@endif
<!-- end Our team-->

<!--Start Health-team-->
<section class="health-team animation-element slide-left">
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="title">
                    <p class="font-weight-bold font-size-30" style="color:#0b2a4c;"> Meet Our Bio-Health Informatics Team</p>
                </div>
                <div class="container-grid">
                    <div class="healthCard">
                        <div class="image">
                            <img src="{{ asset('frontend/img/Dr. Mohamed Kamal.jpg') }}">
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5 style="color: #555555;"><strong>Dr. Mohamed Kamal</strong></h5>
                            </div>
                            <p class="font-size-12" style="color: #555555;">Manager of Clinical Research Unit, 57357, Egypt</p>
                        </div>
                    </div>
                    <div class="healthCard">
                        <div class="image">
                            <img src="{{ asset('frontend/img/Dr. Ahmed Mohamed.jpg') }}">
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5 style="color: #555555;"><strong>Dr. Ahmed Mohamed</strong></h5>
                            </div>
                            <p class="font-size-12" style="color: #555555;">Research Officer, Queensland Ins􀆟tute of Medical Research, Australia.</p>
                        </div>
                    </div>
                    <div class="healthCard">
                        <div class="image">
                            <img src="{{ asset('frontend/img/Marwa Amer2.jpg') }}">
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5 style="color: #555555;"><strong>Dr. Marwa Amer</strong></h5>
                            </div>
                            <p class="font-size-12" style="color: #555555;">Postdoc, Basel University, Switzerland.</p>
                        </div>
                    </div>
                    <div class="healthCard">
                        <div class="image">
                            <img src="{{ asset('frontend/img/Dr. Laila Ziko.jpg') }}">
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5 style="color: #555555;"><strong>Dr. Laila Ziko</strong></h5>
                            </div>
                            <p class="font-size-12" style="color: #555555;">Postdoctoral Researcher at the AUC, Egypt</p>
                        </div>
                    </div>
                </div>
                <div class="container-grid">
                    <div class="healthCard margin-auto">
                        <div class="image">
                            <img src="{{ asset('frontend/img/Dr. Yasser Morsy.jpg') }}">
                        </div>
                        <div class="card-body">
                            <div class="title">
                                <h5 style="color: #555555;"><strong>Dr. Yasser Morsy</strong></h5>
                            </div>
                            <p class="font-size-12" style="color: #555555;">bioinformatics scientist, university hospital Zurich university.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- End Health-team-->

<!-- Start Coming Soon!-->
<section class="coming-soon animation-element slide-left">
    <div class="container coming-container" style="    padding-bottom: 0;">
        <div class="row">
            <div class="title">
                <p class="font-weight-bold font-size-30" style="color:#0b2a4c;">Coming Soon!</p>
            </div>
            <div class="owl-coming owl-carousel owl-theme">
                @foreach($ComingSoons as $k3=>$v3 )
                {!! $v3->$content_var !!}
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- end Coming Soon-->

@endsection
