@extends('layouts.front')
@section('content')



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
                @foreach ($blogs as $blog)
                <div class="blog-size d-flex col-md-12">
                        <h3>{{ $blog->title }}</h3>

                        @if($blog->featured_image)
                            <div class="col-lg-8">
                                <!-- <p>{!! $blog->page_text   !!}</p> -->
                                <p>{!! \Illuminate\Support\Str::limit($blog->page_text, 500)   !!} <a href="/blogs/view/{{$blog->id}}">read more</a></p>

                            </div>
                            <div class="col-lg-4">
                                <img src="{{ $blog->featured_image->getUrl() }}">
                                <!-- <img src="http://localhost/iduni/public/image-004.jpg"> -->
                            </div>
                       @else
                        <div class="col-lg-12">
                            <p>{!! $blog->page_text   !!}</p>
                        </div>
                        @endif
                </div>
                @endforeach
            </div>
            

        </div>

    </div>
</section>

@endsection
