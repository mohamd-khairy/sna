@extends('layouts.front')
@section('content')

<script src="https://www.google.com/recaptcha/api.js?render=6LenjiEbAAAAABmf31UOrboBsyNYGVlyHXcbEvOQ"></script>
<section class="idu-programss">
    <div class="container sit-container">
        <div class="row">
            <div class="title-dyn">
                <h3 class="page-title">Join Us </h3>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/">Home</a>
                    </li>

                    <li class="breadcrumb-item">Join Us </li>
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
                    <form id="contact-form" class="contact-form" action="{{ route('join_create') }}" method="post">
                        @csrf
                        <h2 class="text-center mb-3">Join IDU community</h2>
                        <div class="text-center mb-4">By joining us you can access A lot of exciting and unique lectures and events</div>
                        <div class="form-row">
                            <div class="form-group have-input">
                                <label class="sr-only" for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="2" maxlength="45" required="required" pattern="[A-zÀ-ž]([A-zÀ-ž\s]){2,}"></div>
                            <div class="form-group have-input">
                                <label class="sr-only" for="nationality">Nationality</label>
                                <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Nationality" required="required"></div>

                            <div class="form-group have-input">
                                <label class="sr-only" for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required="required"></div>

                            <div class="form-group have-input">
                                <label class="sr-only" for="mobile">Mobile Number</label>
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Mobile Number"></div>
                            <div class="form-group all emailText">
                                <p>Please make sure your email address is correct as you need it to receive access to the live broadcast session.</p>
                            </div>

                            <!-- <div class="form-group all">
                                <label class="sr-only" for="cmessage">Your message</label>
                                <textarea class="form-control" id="cmessage" name="message" placeholder="A small brief about your education" rows="10" required="required"></textarea></div> -->

                             <div class="programmes_choices">
                                <p class="programmes_label">Which of the following programmes would you be interested in:</p>
                                <!-- <input type="checkbox" class="form-control" name="programmes[]" value="Diploma in Bio-Health Informatics" >
                                <input type="checkbox" class="form-control" name="programmes[]" >Diploma in Bio-Health Informatics -->
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Bio-Health Informatics"><span>Diploma in Bio-Health Informatics</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Cinema"><span>Diploma in Cinema</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Customer Service"><span>Diploma in Customer Service</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Fashion Design"><span>Diploma in Fashion Design</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Egyptology"><span>Diploma in Egyptology</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Legal Informatics"><span>Diploma in Legal Informatics</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Diploma in Radio"><span>Diploma in Radio</span></label><br>
                                  <label><input type="checkbox" name="programmes[]" value="Other"><span>Other</span></label><br>
                                  <br><br>
                            </div>

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
