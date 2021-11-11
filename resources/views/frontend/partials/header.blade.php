@php
$currentRouteName = Route::currentRouteName();
@endphp
<section class="navbar {{ $currentRouteName=='site-home'?'':'fixed-background' }}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1  hidden-small-screen">
                <div class="logo">
                    <a href="{{url('/')}}">
                        <img src="{{ asset('frontend/img/IDU-LOGO2.png') }}" alt="logo">
                    </a>
                </div>
            </div>
            <div class="col-md-9 hidden-small-screen">
                <ul>

                    <!-- <li class="navItem">
                        <a class="fullscreen nav-link">
                            <img src="{{ asset('frontend/img/bg1.png') }}">
                        </a>

                    </li> -->
                    <!-- <li class="navItem">
                        <a href="{{url('/')}}" class=" nav-link">Home</a>
                    </li> -->
                    <!-- <li class="navItem">
                        <a class=" nav-link">My Courses</a>
                    </li> -->
                    <li class="navItem">
                        <a class="dropdown-toggle nav-link">IDU Programmes</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/content/IDU-Programs"> Available Programmes</a>
                            <a class="dropdown-item" href="/content/BioandHealthInformatics-Prog" >Bio-Health Informatics</a>
                            <a class="dropdown-item" href="/content/Egyptology-Prog" >Egyptology</a>
                            <a class="dropdown-item" href="/content/LegalInformatics" >Legal Informatics</a>
                            <a class="dropdown-item" href="/content/Cinema" >دبلومة السينما</a>
                            <a class="dropdown-item" href="/content/Radio" >إذاعة تلفزيونية وراديو</a>
                        </div>
                    </li>
                    <!-- <li class="navItem">
                        <a class=" dropdown-toggle nav-link" >Academic Calendar</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/content/AcademicCalendar">Academic Calendar for Egyptology by Dr. Zahi Hawass Programme</a>
                        </div>
                    </li> -->
                    <li class="navItem">
                        <a class="nav-link" href="https://iduni.net/register">Apply Now</a>
                    </li>
                    
                    <li class="navItem">
                        <a class="dropdown-toggle nav-link">IDU Blogs</a>
                        <div class="dropdown-menu">
                            @foreach($ContentCategory as $onecategory)
                                <a class="dropdown-item" href="/blogs/{{$onecategory->id}}">{{$onecategory->name}}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="navItem">
                        <a class="nav-link" href="/content/Jobs" >Jobs at IDU</a>
                    </li>
                    <li class="navItem">
                        <a class="nav-link" href="/content/Partners">Partners</a>
                    </li>
                    <li class="navItem">
                        <a class="nav-link" href="/contact-us" >Contact Us</a>
                    </li>
                    <li class="navItem">
                        <a class="nav-link" href="/content/About-Us">About Us</a>
                    </li>
                    <!-- <li class="navItem">
                        <a class="dropdown-toggle nav-link">English ‎(en)‎</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item">English ‎(en)</a>
                        </div>
                    </li> -->
                </ul>
            </div>

            <div class="col-md-10 col-sm-4 hidden-large-screen show-small-screen">
                <div class="mobile-toggle">
                    <button>
                        <i class="icon fa fa-bars fa-fw " aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-10 col-sm-4 hidden-large-screen show-small-screen">
                <div class="logo">
                    <img src="{{ asset('frontend/img/IDU-LOGO2.png') }}">
                </div>
            </div>
            <div class="col-md-2 col-sm-4" style="{{ $currentRouteName=='site-home'?'':'padding-left: 0;' }}">
                <div class="rightdiv">
                    <!-- <div class="search">
                        <i class="fa fa-search"></i>
                    </div> -->
                    <div class="login">
                        <i class="fa fa-user"></i>
                        <h4><a style="color: #fff;" href="https://www.learn.iduni.net/login/">Learning Portal</a></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="sidenav">
                <ul>
                    <li class="links  active">
                        <a href="/content/IDU-Programs">
                            <span class="media-left">
                                <i class="icon fa fa-book fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">IDU Programs</span>
                        </a>
                    </li>
                    <li class="links  active">
                        <a href="https://iduni.net/register">
                            <span class="media-left">
                                <i class="icon fa fa-check-circle fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">Apply Now</span>
                        </a>
                    </li>
                    <li class="links  active">
                        <a href="/blogs/1">
                            <span class="media-left">
                                <i class="icon fa fa-cubes fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">IDU Blogs</span>
                        </a>
                    </li>
                    <li class="links  active">
                        <a href="/content/Jobs">
                            <span class="media-left">
                                <i class="icon fa fa-briefcase fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">Jobs at IDU</span>
                        </a>
                    </li>

                    <li class="links  active">
                        <a href="/content/Partners">
                            <span class="media-left">
                                <i class="icon fa fa-question fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">Partners</span>
                        </a>
                    </li>
                    
                    <li class="links  active">
                        <a href="/contact-us">
                            <span class="media-left">
                                <i class="icon fa fa-inbox fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">Contact Us</span>
                        </a>
                    </li>
                    <li class="links  active">
                        <a href="/content/About-Us">
                            <span class="media-left">
                                <i class="icon fa fa-question fa-fw " aria-hidden="true"></i>
                            </span>
                            <span class="media-body">About Us</span>
                        </a>
                    </li>

                </ul>
                <div class="site-menubar-footer">
                    <a><span class="fa fa-archive" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
    </div>
</section>
