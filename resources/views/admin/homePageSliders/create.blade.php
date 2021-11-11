@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.homePageSlider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.home-page-sliders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.homePageSlider.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homePageSlider.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content_ar">{{ trans('cruds.homePageSlider.fields.content_ar') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content_ar') ? 'is-invalid' : '' }}" name="content_ar" id="content_ar">{!! old('content_ar') !!}</textarea>
                @if($errors->has('content_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homePageSlider.fields.content_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content_en">{{ trans('cruds.homePageSlider.fields.content_en') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('content_en') ? 'is-invalid' : '' }}" name="content_en" id="content_en">{!! old('content_en') !!}</textarea>
                @if($errors->has('content_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('content_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homePageSlider.fields.content_en_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.home-page-sliders.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $homePageSlider->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }


});
</script>

@endsection
