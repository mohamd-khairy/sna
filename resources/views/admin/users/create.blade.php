@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.user.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                    @foreach($roles as $id => $roles)
                        <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $roles }}</option>
                    @endforeach
                </select>
                @if($errors->has('roles'))
                    <div class="invalid-feedback">
                        {{ $errors->first('roles') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.program') }}</label>
                <select class="form-control select2 {{ $errors->has('program') ? 'is-invalid' : '' }}" name="program_id" id="program_id">
                    @foreach($programs as $id => $program)
                        <option value="{{ $id }}" {{ old('program_id') == $id ? 'selected' : '' }}>{{ $program }}</option>
                    @endforeach
                </select>
                @if($errors->has('program'))
                    <div class="invalid-feedback">
                        {{ $errors->first('program') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.program_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.user.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', '') }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name_en">{{ trans('cruds.user.fields.full_name_en') }}</label>
                <input class="form-control {{ $errors->has('full_name_en') ? 'is-invalid' : '' }}" type="text" name="full_name_en" id="full_name_en" value="{{ old('full_name_en', '') }}" required>
                @if($errors->has('full_name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.full_name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="full_name_ar">{{ trans('cruds.user.fields.full_name_ar') }}</label>
                <input class="form-control {{ $errors->has('full_name_ar') ? 'is-invalid' : '' }}" type="text" name="full_name_ar" id="full_name_ar" value="{{ old('full_name_ar', '') }}">
                @if($errors->has('full_name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.full_name_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="personal_photo">{{ trans('cruds.user.fields.personal_photo') }}</label>
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
                <label class="required" for="national">{{ trans('cruds.user.fields.national') }}</label>
                <input class="form-control {{ $errors->has('national') ? 'is-invalid' : '' }}" type="text" name="national" id="national" value="{{ old('national', '') }}" required>
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
                <label class="required" for="birth_date">{{ trans('cruds.user.fields.birth_date') }}</label>
                <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
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
                <span class="help-block">{{ trans('cruds.user.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="birth_country">{{ trans('cruds.user.fields.birth_country') }}</label>
                <input class="form-control {{ $errors->has('birth_country') ? 'is-invalid' : '' }}" type="text" name="birth_country" id="birth_country" value="{{ old('birth_country', '') }}" required>
                @if($errors->has('birth_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.birth_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country">{{ trans('cruds.user.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', '') }}" required>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="state">{{ trans('cruds.user.fields.state') }}</label>
                <input class="form-control {{ $errors->has('state') ? 'is-invalid' : '' }}" type="text" name="state" id="state" value="{{ old('state', '') }}" required>
                @if($errors->has('state'))
                    <div class="invalid-feedback">
                        {{ $errors->first('state') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.state_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="linkedin">{{ trans('cruds.user.fields.linkedin') }}</label>
                <input class="form-control {{ $errors->has('linkedin') ? 'is-invalid' : '' }}" type="text" name="linkedin" id="linkedin" value="{{ old('linkedin', '') }}">
                @if($errors->has('linkedin'))
                    <div class="invalid-feedback">
                        {{ $errors->first('linkedin') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.linkedin_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.undergraduate') }}</label>
                <select class="form-control {{ $errors->has('undergraduate') ? 'is-invalid' : '' }}" name="undergraduate" id="undergraduate" required>
                    <option value disabled {{ old('undergraduate', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::UNDERGRADUATE_SELECT as $key => $label)
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
                <label class="required">{{ trans('cruds.user.fields.degree') }}</label>
                <select class="form-control {{ $errors->has('degree') ? 'is-invalid' : '' }}" name="degree" id="degree" required>
                    <option value disabled {{ old('degree', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\User::DEGREE_SELECT as $key => $label)
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
                <label class="required" for="degree_photo">{{ trans('cruds.user.fields.degree_photo') }}</label>
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
                <label for="certificates">{{ trans('cruds.user.fields.certificates') }}</label>
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
                <label for="cv">{{ trans('cruds.user.fields.cv') }}</label>
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
                <label class="required" for="personal_statement">{{ trans('cruds.user.fields.personal_statement') }}</label>
                <textarea class="form-control {{ $errors->has('personal_statement') ? 'is-invalid' : '' }}"  name="personal_statement" id="personal_statement"  required>{{ old('personal_statement') }}</textarea>
                @if($errors->has('personal_statement'))
                    <div class="invalid-feedback">
                        {{ $errors->first('personal_statement') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.personal_statement_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.user.fields.know_us') }}</label>
                @foreach(App\Models\User::KNOW_US_RADIO as $key => $label)
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
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.personalPhotoDropzone = {
    url: '{{ route('admin.users.storeMedia') }}',
    maxFilesize: 7, // MB
   // acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 7,
    //  width: 4096,
    //  height: 4096
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
//    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 7
  //    width: 4096,
   //   height: 4096
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
//    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 7
 //     width: 4096,
  //    height: 4096
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
  //  acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 7
 //     width: 4096,
  //    height: 4096
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
@endsection
