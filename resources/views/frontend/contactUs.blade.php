@extends('layouts.front')
@section('content')

<script src="https://www.google.com/recaptcha/api.js?render=6LenjiEbAAAAABmf31UOrboBsyNYGVlyHXcbEvOQ"></script>
<section class="idu-programss">
    <div class="container sit-container">
        <div class="row">
            <div class="title-dyn">
                <h3 class="page-title">Contact Us </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>

                    <li class="breadcrumb-item">Contact Us </li>
                </ol>
            </div>
        </div>

        <div class="row background-row row background-row space-row">

            <div class="tabcontent">
                <div class="contact-form-box rounded p-lg-5 mb-5">
                    <!-- <form id="contact-form" class="contact-form" action="../contact/index.php" method="post"> -->
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
                    <form id="contact-form" class="contact-form" action="{{ route('enquiry_create') }}" method="post">
                        @csrf
                        <h2 class="text-center mb-3">How Can We Help?</h2>
                        <div class="text-center mb-4">Want to get in touch with us or have a question? Fill out this form</div>
                        <div class="form-row">
                            <div class="form-group have-input">
                                <label class="sr-only" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="2" maxlength="45" required="required" pattern="[A-zÀ-ž]([A-zÀ-ž\s]){2,}"></div>
                            <div class="form-group have-input">
                                <label class="sr-only" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required"></div>

                            <div class="form-group all">
                                <label class="sr-only" for="cmessage">Your message</label>
                                <textarea class="form-control" id="cmessage" name="message" placeholder="Enter your message" rows="10" required="required"></textarea></div>

                            <input type="hidden" name="g-recaptcha-response" id='g-recaptcha-response'>

                            <!-- <input type="hidden" id="sesskey" name="sesskey" value="IKAWLZQUP8">
                            <script>
                                document.getElementById('sesskey').value = M.cfg.sesskey;
                            </script> -->
                            <div class="form-group all">
                                <input type="submit" name="submit" id="submit" value="Send" class="btn btn-block btn-primary py-2"></div>
                        </div>
                    </form>
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
