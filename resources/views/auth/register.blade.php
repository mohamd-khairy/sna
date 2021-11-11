@php
$lang = app()->getLocale();
$ContentCategory = \App\Models\ContentCategory::get();

if($lang=='ar'){
    $know_us_radios = App\Models\User::KNOW_US_RADIO_AR;   
    $undergraduate_select = App\Models\User::UNDERGRADUATE_SELECT_AR;
    $degree_select = App\Models\User::DEGREE_SELECT_AR;
    $arabic_class = "ar-form";
    $programs_list = App\Models\Programme::select('id','name_ar')->where('active',1)->get();
}else{
    $know_us_radios = App\Models\User::KNOW_US_RADIO;
    $undergraduate_select = App\Models\User::UNDERGRADUATE_SELECT;
    $degree_select = App\Models\User::DEGREE_SELECT;
    $arabic_class = "";
    $programs_list = App\Models\Programme::select('id','name')->where('active',1)->get();
}
@endphp

@extends( (!empty($_GET['NewStyle']))? 'layouts.app' : 'layouts.front',[$ContentCategory])


@section('content')

<section class="register {{$arabic_class}}">
    <div class="container">
        <div class="row">
                
            <div class="col-md-6 reg-nopadding reg-textBox">
                <div class="title-dyn">
                    <h3 class="page-title">{{ trans('frontend.register.Apply Now') }}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#/">{{ trans('frontend.register.Home') }}</a></li>
                        <li class="breadcrumb-item">{{ trans('frontend.register.Apply Now') }}</li>
                    </ol>
                </div>
            </div>
            <div class="col-md-6 reg-nopadding reg-switchBox">
                <div class="title-dyn" >
                    <button class="btn btn-primary btn-lg language-button" role="button">
                        @if($lang=='ar')
                            <a href="/en/register">Go to the English Form</a>
                        @else
                            <a href="/ar/register">اضغط هنا لملئ الاستمارة باللغة العربية</a>
                        @endif
                    </button>
                </div>
            </div>

        </div>
        <div class="row  background-row space-row ">
            <div class="new-containerR">

<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card mx-4">
            <div class="card-body p-4">

                <form method="POST" id="formABC"  action="{{ route('register',['locale'=>$lang]) }}">
                    {{ csrf_field() }}

                    <h1> {{ trans('frontend.register.APPLICATION FORM') }}</h1>

                    @if(count($errors) > 0)
                        <div class="custom_register_failed_msg">
                            <p>
                                {{ trans('frontend.register.failed_msg') }}
                            </p>
                        </div>
                    @endif

                    <!-- <img src="{{ asset('IDU-LOGO2-02.png') }}" class="col-lg-2 offset-5"> -->
                    <p class="">{{ trans('frontend.register.desc1') }} </p>
                    <p class="">{{ trans('frontend.register.desc2') }}</p>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-envelope fa-fw"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('frontend.register.Email') }}" value="{{ old('email', null) }}">
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
                        <input type="password" id="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required minlength="8" maxlength="50" placeholder="{{ trans('frontend.register.Password') }}">
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
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" minlength="8" maxlength="50" required placeholder="{{ trans('frontend.register.Password confirmation') }}">
                    </div>

                    <div class="form-group">
                        <label class="required">{{ trans('frontend.register.Which Program') }}</label>
                        @foreach($programs_list as $programe)
                            <div class="form-check {{ $errors->has('program') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="program_{{ $programe->id }}" name="program_id" value="{{ $programe->id }}" {{ old('program', '') === (string) $programe->id ? 'checked' : '' }} required>

                                @if($lang=="ar")
                                    <label class="form-check-label" for="program_{{ $programe->id }}">{{ $programe->name_ar }}</label>
                                @else
                                    <label class="form-check-label" for="program_{{ $programe->id }}">{{ $programe->name }}</label>
                                @endif

                            </div>
                        @endforeach
                        @if($errors->has('program'))
                            <div class="invalid-feedback">
                                {{ $errors->first('program') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.program_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required d-block" for="name">{{ trans('frontend.register.Name') }}</label>
                        <select class="form-control col-auto d-inline" id="title" name="name_title">
                                <option value="">{{ trans('frontend.register.Title') }}</option>
                                <option value="Ms.">Ms.</option>
                                <option value="Mr.">Mr.</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Prof.">Prof.</option>
                        </select>
                        <input type="text" name="name" id="myUsername" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} col-auto d-inline" required autofocus placeholder="{{ trans('frontend.register.Name') }}" value="{{ old('name', null) }}">
                        @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="required" for="last_name">{{ trans('frontend.register.Last Name') }}</label>
                        <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" minlength="5" maxlength="50" value="{{ old('last_name', '') }}" required>
                        @if($errors->has('last_name'))
                            <div class="invalid-feedback">
                                {{ $errors->first('last_name') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="full_name_en">{{ trans('frontend.register.Full Name English') }}</label>
                        <input class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}" type="text" name="full_name_en" id="full_name_en" minlength="3" maxlength="50" value="{{ old('full_name_en', '') }}" required >
                        @if($errors->has('full_name_en'))
                            <div class="invalid-feedback">
                                {{ $errors->first('full_name_en') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.full_name_en_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="full_name_ar">{{ trans('frontend.register.Full Name Arabic') }}</label>
                        <input class="form-control {{ $errors->has('full_name_ar') ? 'is-invalid' : '' }}" type="text" name="full_name_ar" id="full_name_ar" value="{{ old('full_name_ar', '') }}">
                        @if($errors->has('full_name_ar'))
                            <div class="invalid-feedback">
                                {{ $errors->first('full_name_ar') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.full_name_ar_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="personal_photo">{{ trans('frontend.register.Personal Photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('personal_photo') ? 'is-invalid' : '' }}" id="personal_photo-dropzone">
                        </div>
                        @if($errors->has('personal_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('personal_photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.personal_photo_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="national">{{ trans('frontend.register.Passport or National ID Number') }}</label>
                        <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" minlength="5" maxlength="20" value="{{ old('national', '') }}" required>
                        @if($errors->has('national'))
                            <div class="invalid-feedback">
                                {{ $errors->first('national') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.national_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="id_photo">{{ trans('frontend.register.Photo of Passport or National ID') }}</label>
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
                        <label class="required d-block" for="birth_date">{{ trans('frontend.register.Date of Birth') }}</label>
                        <select class="form-control col-auto d-inline" id="day" onchange="onChoose()" required>
                            <option value="">{{ trans('frontend.register.Day') }}</option>
                            <option value="01">1</option>
                            <option value="02">2</option>
                            <option value="03">3</option>
                            <option value="04">4</option>
                            <option value="05">5</option>
                            <option value="06">6</option>
                            <option value="07">7</option>
                            <option value="08">8</option>
                            <option value="09">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                        <select class="form-control col-auto d-inline" id="month" onchange="onChoose()" required>
                            <option value="">{{ trans('frontend.register.Month') }}</option>
                            <option value="01">{{ trans('frontend.register.January') }}</option>
                            <option value="02">{{ trans('frontend.register.February') }}</option>
                            <option value="03">{{ trans('frontend.register.March') }}</option>
                            <option value="04">{{ trans('frontend.register.April') }}</option>
                            <option value="05">{{ trans('frontend.register.May') }}</option>
                            <option value="06">{{ trans('frontend.register.June') }}</option>
                            <option value="07">{{ trans('frontend.register.July') }}</option>
                            <option value="08">{{ trans('frontend.register.August') }}</option>
                            <option value="09">{{ trans('frontend.register.September') }}</option>
                            <option value="10">{{ trans('frontend.register.October') }}</option>
                            <option value="11">{{ trans('frontend.register.November') }}</option>
                            <option value="12">{{ trans('frontend.register.December') }}</option>
                        </select>
                        <select class="form-control col-auto d-inline" id="year" onchange="onChoose()" required>
                            <option value="">{{ trans('frontend.register.Year') }}</option>
                            <option value="1940">1940</option>
                            <option value="1941">1941</option>
                            <option value="1942">1942</option>
                            <option value="1943">1943</option>
                            <option value="1944">1944</option>
                            <option value="1945">1945</option>
                            <option value="1946">1946</option>
                            <option value="1947">1947</option>
                            <option value="1948">1948</option>
                            <option value="1949">1949</option>
                            <option value="1950">1950</option>
                            <option value="1951">1951</option>
                            <option value="1952">1952</option>
                            <option value="1953">1953</option>
                            <option value="1954">1954</option>
                            <option value="1955">1955</option>
                            <option value="1956">1956</option>
                            <option value="1957">1957</option>
                            <option value="1958">1958</option>
                            <option value="1959">1959</option>
                            <option value="1960">1960</option>
                            <option value="1961">1961</option>
                            <option value="1962">1962</option>
                            <option value="1963">1963</option>
                            <option value="1964">1964</option>
                            <option value="1965">1965</option>
                            <option value="1966">1966</option>
                            <option value="1967">1967</option>
                            <option value="1968">1968</option>
                            <option value="1969">1969</option>
                            <option value="1970">1970</option>
                            <option value="1971">1971</option>
                            <option value="1972">1972</option>
                            <option value="1973">1973</option>
                            <option value="1974">1974</option>
                            <option value="1975">1975</option>
                            <option value="1976">1976</option>
                            <option value="1977">1977</option>
                            <option value="1978">1978</option>
                            <option value="1979">1979</option>
                            <option value="1980">1980</option>
                            <option value="1981">1981</option>
                            <option value="1982">1982</option>
                            <option value="1983">1983</option>
                            <option value="1984">1984</option>
                            <option value="1985">1985</option>
                            <option value="1986">1986</option>
                            <option value="1987">1987</option>
                            <option value="1988">1988</option>
                            <option value="1989">1989</option>
                            <option value="1990">1990</option>
                            <option value="1991">1991</option>
                            <option value="1992">1992</option>
                            <option value="1993">1993</option>
                            <option value="1994">1994</option>
                            <option value="1995">1995</option>
                            <option value="1996">1996</option>
                            <option value="1997">1997</option>
                            <option value="1998">1998</option>
                            <option value="1999">1999</option>
                            <option value="2000">2000</option>
                            <option value="2001">2001</option>
                            <option value="2002">2002</option>
                            <option value="2003">2003</option>
                            <option value="2004">2004</option>
                            <option value="2005">2005</option>
                            <option value="2006">2006</option>
                            <option value="2007">2007</option>
                        </select>
                        <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" hidden style="display: none !important;">
                        @if($errors->has('birth_date'))
                            <div class="invalid-feedback">
                                {{ $errors->first('birth_date') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.birth_date_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="phone">{{ trans('frontend.register.Phone Number') }}</label>
                        <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
                        @if($errors->has('phone'))
                            <div class="invalid-feedback">
                                {{ $errors->first('phone') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('frontend.register.phone_hint') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="birth_country">{{ trans('frontend.register.Country of birth') }}</label>
                        <input class="form-control {{ $errors->has('birth_country') ? 'is-invalid' : '' }}" type="text" name="birth_country" id="birth_country" value="{{ old('birth_country', '') }}" required>
                        @if($errors->has('birth_country'))
                            <div class="invalid-feedback">
                                {{ $errors->first('birth_country') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.birth_country_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="country">{{ trans('frontend.register.Country of residence') }}</label>
                        <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
                        @if($errors->has('country'))
                            <div class="invalid-feedback">
                                {{ $errors->first('country') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="state">{{ trans('frontend.register.State of residence') }}</label>
                        <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                        @if($errors->has('state'))
                            <div class="invalid-feedback">
                                {{ $errors->first('state') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="linkedin">{{ trans('frontend.register.Link of LinkedIn') }}</label>
                        <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                        @if($errors->has('linkedin'))
                            <div class="invalid-feedback">
                                {{ $errors->first('linkedin') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.linkedin_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('frontend.register.Field of your undergraduate study') }}</label>
                        <select class="form-control {{ $errors->has('undergraduate') ? 'is-invalid' : '' }}" name="undergraduate" id="undergraduate" required>
                            <option value disabled {{ old('undergraduate', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($undergraduate_select as $key => $label)
                                <option value="{{ $key }}" {{ old('undergraduate', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('undergraduate'))
                            <div class="invalid-feedback">
                                {{ $errors->first('undergraduate') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.undergraduate_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('frontend.register.Your latest educational degree') }}</label>
                        <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                            <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                            @foreach($degree_select as $key => $label)
                                <option value="{{ $key }}" {{ old('degree', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('degree'))
                            <div class="invalid-feedback">
                                {{ $errors->first('degree') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.degree_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="degree_photo">{{ trans('frontend.register.Degree Photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('degree_photo') ? 'is-invalid' : '' }}" id="degree_photo-dropzone">
                        </div>
                        @if($errors->has('degree_photo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('degree_photo') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.degree_photo_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="certificates">{{ trans('frontend.register.Certificates Photo') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('certificates') ? 'is-invalid' : '' }}" id="certificates-dropzone">
                        </div>
                        @if($errors->has('certificates'))
                            <div class="invalid-feedback">
                                {{ $errors->first('certificates') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.certificates_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="cv">{{ trans('frontend.register.Curriculum vitae') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('cv') ? 'is-invalid' : '' }}" id="cv-dropzone">
                        </div>
                        @if($errors->has('cv'))
                            <div class="invalid-feedback">
                                {{ $errors->first('cv') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.cv_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="personal_statement">{{ trans('frontend.register.Personal Statement') }}</label>
                        <textarea class="form-control {{ $errors->has('personal_statement') ? 'is-invalid' : '' }}"  name="personal_statement" id="personal_statement"  required>{{ old('personal_statement') }}</textarea>
                        @if($errors->has('personal_statement'))
                            <div class="invalid-feedback">
                                {{ $errors->first('personal_statement') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.personal_statement_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required">{{ trans('frontend.register.How know about us') }}</label>
                        @foreach($know_us_radios as $key => $label)
                            <div class="form-check {{ $errors->has('know_us') ? 'is-invalid' : '' }}">
                                <input class="form-check-input" type="radio" id="know_us_{{ $key }}" name="know_us" value="{{ $key }}" {{ old('know_us', '') === (string) $key ? 'checked' : '' }} required>
                                <label class="form-check-label" for="know_us_{{ $key }}">{{ $label }}</label>
                            </div>
                        @endforeach
                        @if($errors->has('know_us'))
                            <div class="invalid-feedback">
                                {{ $errors->first('know_us') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.user.fields.know_us_helper') }}</span>
                    </div>
                    <button id="btnSubmit" class="btn btn-block btn-primary">
                        {{ trans('frontend.register.Apply Now button') }}
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

</div>
</div>
</div>
</section>
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
