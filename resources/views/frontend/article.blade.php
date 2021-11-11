@extends('layouts.front')
@section('content')
<script src="https://www.google.com/recaptcha/api.js?render=6LenjiEbAAAAABmf31UOrboBsyNYGVlyHXcbEvOQ"></script>


<section class="idu-programss">
    <div class="container sit-container">
        <div class="row">
            <div class="title-dyn">
                <h3 class="page-title">IDU Blogs </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>

                    <li class="breadcrumb-item">Blogs</li>
                </ol>
            </div>
        </div>

        <div class="row background-row row background-row space-row">

            <div class="tabcontent">
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                           {{Session::get('fail')}}
                        </div>
                    @endif
                <div class="blog-size d-flex col-md-12">
                        <h3>{{ $blog->title }}</h3>

                        @if($blog->featured_image)
                            <!-- <div class="col-lg-12">
                                <img src="{{ $blog->featured_image->getUrl() }}">
                            </div> -->
                            <div class="col-lg-12 blogText">
                                <p>{!! $blog->page_text   !!} </p>
                            </div>
                       @else
                        <div class="col-lg-12 blogText">
                            <p>{!! $blog->page_text   !!}</p>
                        </div>
                        @endif
                </div>                
            </div>




            <div class="tabcontent">
                    <div class="section-comments">
                        <div class="section-header">
                            <h3 class="section-title">Comments ({{count($approved_comments)}})</h3>
                            <img src="{{ asset('frontend/img/wave.svg') }}" class="wave" alt="wave">
                        </div>
                        @if(!empty($approved_comments))
                        <div class="comments bordered padding-30 rounded">

                            <ul class="comments">
                                @foreach($approved_comments as $c_comment)
                                    <!-- comment item -->
                                    <li class="comment rounded">
                                        <div class="thumb">
                                            <img src="{{ asset('frontend/img/default_user.png') }}" class="default_user" alt="John Doe">
                                        </div>
                                        <div class="details">
                                            <h4 class="name"><a href="javascript:;">{{$c_comment['name']}}</a></h4>
                                            <span class="date"> {{date("M d, Y H:i:m",strtotime($c_comment['created_at']))}}</span>
                                            <p>{{$c_comment['comment']}}</p>
                                            <!-- <a href="#" class="btn btn-default btn-sm">Reply</a> -->
                                        </div>
                                    </li>
                                    <!-- comment item -->
                                @endforeach
                                <!-- <li class="comment child rounded">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/img/default_user.png') }}" class="default_user" alt="John Doe">
                                    </div>
                                    <div class="details">
                                        <h4 class="name"><a href="#">Helen Doe</a></h4>
                                        <span class="date">Jan 08, 2021 14:41 pm</span>
                                        <p>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum.</p>
                                        <a href="#" class="btn btn-default btn-sm">Reply</a>
                                    </div>
                                </li> -->
                                
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="section-leave-comments section-comments">
                        <div class="section-header">
                            <h3 class="section-title">Leave Comment</h3>
                            <img src="{{ asset('frontend/img/wave.svg') }}" class="wave" alt="wave">
                        </div>
                        <div class="comment-form rounded bordered padding-30">

                            <form id="comment-form" class="comment-form" action="{{ route('comment_create') }}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{Request::segment(3)}}">
                                <div class="messages"></div>

                                <div class="row">

                                    <div class="column col-md-12">
                                        <!-- Comment textarea -->
                                        <div class="form-group">
                                            <textarea name="comment" id="InputComment" class="form-control" rows="4" placeholder="Your comment here..." required="required"></textarea>
                                        </div>
                                    </div>

                                    <div class="column col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="InputName" name="name" placeholder="Your name" required="required">
                                        </div>
                                    </div>

                                    <div class="column col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="InputEmail" name="email" placeholder="Email address" required="required">
                                        </div>
                                    </div>
                                    <div class="column col-md-6">
                                        <div class="form-group">
                                            <input type="phone" class="form-control" id="InputPhone" name="phone" placeholder="Phone" required="required">
                                        </div>
                                    </div>

                                    <input type="hidden" name="g-recaptcha-response" id='g-recaptcha-response'>

                                </div>

                                <button type="submit" name="submit" id="submit" value="Submit" class="btn btn-default">Submit</button>
                                <!-- Submit Button -->

                            </form>
                        </div>
                    </div>
                </div>



            

        </div>

    </div>
</section>

<script>
grecaptcha.ready(function() {
    grecaptcha.execute('6LenjiEbAAAAABmf31UOrboBsyNYGVlyHXcbEvOQ', {action: 'submit'}).then(function(token) {
        document.getElementById('g-recaptcha-response').value = token;
    });
});
</script>

@endsection
