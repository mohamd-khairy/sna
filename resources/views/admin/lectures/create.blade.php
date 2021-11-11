@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.lecture.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.lectures.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.lecture.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="date">{{ trans('cruds.lecture.fields.date') }}</label>
                <input class="form-control date {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date') }}" required>
                @if($errors->has('date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="time">{{ trans('cruds.lecture.fields.time') }}</label>
                <input class="form-control timepicker {{ $errors->has('time') ? 'is-invalid' : '' }}" type="text" name="time" id="time" value="{{ old('time') }}" required>
                @if($errors->has('time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="instructor">{{ trans('cruds.lecture.fields.instructor') }}</label>
                <input class="form-control {{ $errors->has('instructor') ? 'is-invalid' : '' }}" type="text" name="instructor" id="instructor" value="{{ old('instructor', '') }}" required>
                @if($errors->has('instructor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('instructor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.instructor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_forign">{{ trans('cruds.lecture.fields.price_forign') }}</label>
                <input class="form-control {{ $errors->has('price_forign') ? 'is-invalid' : '' }}" type="number" name="price_forign" id="price_forign" value="{{ old('price_forign', '') }}" step="0.01" required>
                @if($errors->has('price_forign'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_forign') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.price_forign_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price_egyption">{{ trans('cruds.lecture.fields.price_egyption') }}</label>
                <input class="form-control {{ $errors->has('price_egyption') ? 'is-invalid' : '' }}" type="number" name="price_egyption" id="price_egyption" value="{{ old('price_egyption', '') }}" step="0.01" required>
                @if($errors->has('price_egyption'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_egyption') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.price_egyption_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.lecture.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.lecture.fields.description_helper') }}</span>
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
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/lectures/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $lecture->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection