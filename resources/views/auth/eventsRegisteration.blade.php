@extends('layouts.app')
@section('content')

<div class="row justify-content-center">
    <div class="col-md-9">

        <div class="card mx-4">
            <div class="card-body p-4">
                @include('flash-message')
                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <form method="POST" id="formABC"  action="{{ route('eventsRegisterationSave') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="is_event_registeration" value="1">
                    <img src="{{ asset('new-logo.jpg') }}" class="col-lg-2 offset-5">
                    <h2 class="main-ltitle"> ‘How the great Pyramid oh KHUFU was built’</br>
                        By Dr. Zahi Hawass </br>
                        Registration form</h2>
                    <p class="text-muted">Kindly fill in and submit this registration form </p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required minlength="8" maxlength="50" placeholder="{{ trans('global.login_password') }}">
                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-lock fa-fw"></i>
                            </span>
                        </div>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" maxlength="50" required placeholder="{{ trans('global.login_password_confirmation') }}">
                    </div>

                    @if(false)
                    <div class="form-group">
                        <label class="required">{{ trans('cruds.user.fields.program') }}</label>
                        @foreach(App\Models\User::PROGRAM_RADIO as $key => $label)
                            <div class="form-check {{ $errors->has('program') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="program_{{ $key }}" name="program" value="{{ $key }}" {{ old('program', '') === (string) $key ? 'checked' : '' }} required>
                                <label class="form-check-label" for="program_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                        @if($errors->has('program'))
                            <div class="invalid-feedback">
                                {{ $errors->first('program') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.program_helper') }}</span>
                    </div>
                    @endif

                    <div class="form-group">
                        <label class="required d-block" for="name">{{  trans('global.user_name')  }}</label>
                        <select class="form-control col-auto d-inline" id="title" name="name_title">
                                <option value="">Title</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                        </select>

                        <input type="text" name="name" id="myUsername" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} col-auto d-inline" required autofocus placeholder="{{ trans('global.first_name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                        @endif

                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }} col-auto d-inline" type="text" name="last_name" id="last_name" minlength="5" maxlength="50" placeholder="{{ trans('global.last_name') }}" value="{{ old('last_name', '') }}" required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                    </div>


                    @if(false)
                    <div class="form-group">
                        <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" minlength="5" maxlength="50" value="{{ old('last_name', '') }}" required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                    </div>
                    @endif
                    
                    <div class="form-group">
                        <label class="required" for="national">{{ trans('cruds.user.fields.national') }}</label>
                        <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" minlength="5" maxlength="20" value="{{ old('national', '') }}" required>
                        @if($errors->has('national'))
                            <div class="invalid-feedback">
                                {{ $errors->first('national') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.national_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="id_photo">{{ trans('cruds.user.fields.id_photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('id_photo') ? 'is-invalid' : '' }}" id="id_photo-dropzone">
                        </div>
                        @if($errors->has('id_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('id_photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.id_photo_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required d-block" for="birth_date">{{ trans('cruds.user.fields.birth_date') }}</label>
                        <select class="form-control col-auto d-inline" id="day" name="birth_day" onchange="onChoose()"  required>
                            <option value="">Day</option>
                            @for($k=1;$k<32;$k++)
                                <option value="{{$k}}" {{ old('birth_day', '')==$k?'selected':'' }} >{{$k}}</option>
                            @endfor
                        </select>
        
                        <select class="form-control col-auto d-inline" id="month" name="birth_month" onchange="onChoose()" required>
                            <option value="">Month</option>
                            <option value="01" {{ old('birth_month', '')=='01'?'selected':'' }}>January</option>
                            <option value="02" {{ old('birth_month', '')=='02'?'selected':'' }}>February</option>
                            <option value="03" {{ old('birth_month', '')=='03'?'selected':'' }}>March</option>
                            <option value="04" {{ old('birth_month', '')=='04'?'selected':'' }}>April</option>
                            <option value="05" {{ old('birth_month', '')=='05'?'selected':'' }}>May</option>
                            <option value="06" {{ old('birth_month', '')=='06'?'selected':'' }}>June</option>
                            <option value="07" {{ old('birth_month', '')=='07'?'selected':'' }}>July</option>
                            <option value="08" {{ old('birth_month', '')=='08'?'selected':'' }}>August</option>
                            <option value="09" {{ old('birth_month', '')=='09'?'selected':'' }}>September</option>
                            <option value="10" {{ old('birth_month', '')=='10'?'selected':'' }}>October</option>
                            <option value="11" {{ old('birth_month', '')=='11'?'selected':'' }}>November</option>
                            <option value="12" {{ old('birth_month', '')=='12'?'selected':'' }}>December</option>
                        </select>
                        <select class="form-control col-auto d-inline" name="birth_year" id="year" onchange="onChoose()" required>
                            <option value="">Year</option>
                            @for($i=1940;$i<2008;$i++)
                                <option value="{{$i}}" {{ old('birth_year', '')==$i?'selected':'' }}>{{$i}}</option>
                            @endfor
                        </select>
                        <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" hidden>
                        @if($errors->has('birth_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('birth_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.birth_date_helper') }}</span>
                    </div>

                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('cruds.user.fields.phone') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="form-group">
                        <label class="required" for="nationality">{{ trans('cruds.user.fields.nationality') }}</label>
                        <select class="form-control select2 {{ $errors->has('nationality') ? 'is-invalid' : '' }}" name="nationality" id="nationality" required>
                            @foreach($all_countries as $ccode => $acountry)
                                <option value="{{ $ccode }}">{{ $acountry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('nationality'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nationality') }}
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                        <select class="form-control select2 {{ $errors->has('country') ? 'is-invalid' : '' }}" name="country" id="country" required>
                            @foreach($all_countries as $ccode => $acountry)
                                <option value="{{ $ccode }}">{{ $acountry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('country'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country') }}
                            </div>
                        @endif
                    </div>
                    

                    <button id="btnSubmit" class="btn btn-block btn-primary">
                        Register Now
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection

@section('scripts')
    <script>
        Dropzone.options.personalPhotoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 7, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.pdf,.doc',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 7
      //          width: 4096,
       //         height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="personal_photo"]').remove()
                $('form').append('<input type="hidden" name="personal_photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="personal_photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->personal_photo)
                var file = {!! json_encode($user->personal_photo) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="personal_photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.idPhotoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 7, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.pdf,.doc',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 7
  //              width: 4096,
   //             height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="id_photo"]').remove()
                $('form').append('<input type="hidden" name="id_photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="id_photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->id_photo)
                var file = {!! json_encode($user->id_photo) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="id_photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.degreePhotoDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 7, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.pdf,.doc',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 7
     //           width: 4096,
     //           height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="degree_photo"]').remove()
                $('form').append('<input type="hidden" name="degree_photo" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="degree_photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->degree_photo)
                var file = {!! json_encode($user->degree_photo) !!}
                    this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="degree_photo" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        var uploadedCertificatesMap = {}
        Dropzone.options.certificatesDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 7, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.pdf,.doc',
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 7
     //           width: 4096,
     //           height: 4096
            },
            success: function (file, response) {
                $('form').append('<input type="hidden" name="certificates[]" value="' + response.name + '">')
                uploadedCertificatesMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedCertificatesMap[file.name]
                }
                $('form').find('input[name="certificates[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($user) && $user->certificates)
                var files = {!! json_encode($user->certificates) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="certificates[]" value="' + file.file_name + '">')
                }
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        Dropzone.options.cvDropzone = {
            url: '{{ route('admin.users.storeMedia') }}',
            maxFilesize: 7, // MB
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 7
            },
            success: function (file, response) {
                $('form').find('input[name="cv"]').remove()
                $('form').append('<input type="hidden" name="cv" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="cv"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($user) && $user->cv)
                var file = {!! json_encode($user->cv) !!}
                    this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="cv" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
    <script>
        var password = document.getElementById("password")
            , confirm_password = document.getElementById("password_confirmation");

        function validatePassword(){
            if(password.value != confirm_password.value) {
                confirm_password.setCustomValidity("Passwords Don't Match");
            } else {
                confirm_password.setCustomValidity('');
            }
        }

        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;
    </script>
    <script>
        $(document).ready(function () {

            $("#formABC").submit(function (e) {

                //disable the submit button
                $("#btnSubmit").attr("disabled", true);

                return true;

            });
        });
    </script>
    <script>
        function onChoose(){
            var date = document.getElementById("birth_date")
                ,day = document.getElementById("day")
                ,month = document.getElementById("month")
                ,year = document.getElementById("year");
            date.value = day.value+'-'+month.value+'-'+year.value;
        }
    </script>
@endsection
