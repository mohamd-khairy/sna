@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.system_email.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.system-emails.update", [$system_email->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <!-- *************** Name Dropdown *************** -->
            <div class="form-group">
                <label class="required">Name (the action needed)</label>
                <select class="form-control select2 {{ $errors->has('name_id') ? 'is-invalid' : '' }}" name="name_id" id="name_id">
                    @foreach($system_emails_names as $name_id => $name_info)
                        <option value="{{ $name_id }}" {{ (old('name_id') ? old('name_id') : $system_email->name_id ?? '') == $name_id ? 'selected' : '' }}>{{ $name_info }}</option>
                    @endforeach
                </select>
                @if($errors->has('name_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_id') }}
                    </div>
                @endif
            </div>

            <!-- *************** Type (General - program - lecture) *************** -->
            <div class="form-group">
                <label class="required">Type (Choose if this email content will be for a lecture, a program or General )</label>
                <select class="form-control select2 {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    @foreach($system_emails_types as $type_id => $type_info)
                        <option value="{{ $type_id }}" {{ (old('type') ? old('type') : $system_email->type ?? '') == $type_id ? 'selected' : '' }}>{{ $type_info }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
            </div>

            <!-- *************** programs dropdown *************** -->
            <div class="form-group" id="programmes_field">
                <label class="required">Programme</label>
                <select class="form-control select2 {{ $errors->has('program_id') ? 'is-invalid' : '' }}" name="program_id" id="program_id">
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}" {{ (old('program_id') ? old('program_id') : $system_email->program_id ?? '') == $programme->name ? 'selected' : '' }}>{{ $programme->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('program_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('program_id') }}
                    </div>
                @endif
            </div>

            <!-- *************** lectures dropdown *************** -->
            <div class="form-group" id="lectures_field">
                <label class="required">Lectures</label>
                <select class="form-control select2 {{ $errors->has('lecture_id') ? 'is-invalid' : '' }}" name="lecture_id" id="lecture_id">
                    @foreach($lectures as $lecture)
                        <option value="{{ $lecture->id }}" {{ (old('lecture_id') ? old('lecture_id') : $system_email->lecture_id ?? '') == $lecture->name ? 'selected' : '' }}>{{ $lecture->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('lecture_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('lecture_id') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="subject">{{ trans('cruds.system_email.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', $system_email->subject) }}" required>
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.subject_helper') }}</span>
            </div>
            
            <div class="form-group">
                <label for="message">{{ trans('cruds.system_email.fields.message') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{!! old('message', $system_email->message) !!}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.message_helper') }}</span>
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
                xhr.open('POST', '/admin/system-emails/ckmedia', true);
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
                data.append('crud_id', '{{ $systen_email->id ?? 0 }}');
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
    //************************
    if($("#type").val()=="1"){
        $("#programmes_field").hide();
        $("#lectures_field").hide();
    }else if($("#type").val()=="2"){
        $("#programmes_field").show();
        $("#lectures_field").hide();
    }else if($("#type").val()=="3"){
        $("#programmes_field").hide();
        $("#lectures_field").show();
    }
    $("#type").change(function(){
        if($("#type").val()=="1"){
            $("#programmes_field").hide();
            $("#lectures_field").hide();
        }else if($("#type").val()=="2"){
            $("#programmes_field").show();
            $("#lectures_field").hide();
        }else if($("#type").val()=="3"){
            $("#programmes_field").hide();
            $("#lectures_field").show();
        }
    });
    //************************
});
</script>

@endsection