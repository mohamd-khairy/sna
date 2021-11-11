@extends('layouts.admin')

@section('styles')
<style type="text/css">
    #subject_field,#content_field{
        display: none;
    }
</style>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.system_email.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.system-emails.store") }}" enctype="multipart/form-data">
            @csrf

            @if(false)
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.system_email.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="form-group">
                <label class="required" for="slug">{{ trans('cruds.system_email.fields.slug') }}</label>
                <input class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" type="text" name="slug" id="slug" value="{{ old('slug', '') }}" required>
                @if($errors->has('slug'))
                    <div class="invalid-feedback">
                        {{ $errors->first('slug') }}
                    </div>
                @endif
            </div>
            @endif

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

            <!-- *************** Search button *************** -->
            <div class="form-group">
                <button class="btn btn-dark" type="submit" id="search_emails">
                    Search for existing emails
                </button>
            </div>
            <div id='loader' class="offset-4 " style='display: none;'>
                <img src="{{ asset('reload.gif') }}" width='150px' height='150px'>
            </div>
            <div id='return_url'>
            </div>

            
            <div class="form-group" id="subject_field">
                <label class="required" for="subject">{{ trans('cruds.system_email.fields.subject') }}</label>
                <input class="form-control {{ $errors->has('subject') ? 'is-invalid' : '' }}" type="text" name="subject" id="subject" value="{{ old('subject', '') }}" required>
                @if($errors->has('subject'))
                    <div class="invalid-feedback">
                        {{ $errors->first('subject') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.subject_helper') }}</span>
            </div>
            
            <div class="form-group" id="content_field">
                <label for="message">{{ trans('cruds.system_email.fields.message') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{!! old('message') !!}</textarea>
                @if($errors->has('message'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.system_email.fields.message_helper') }}</span>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit" disabled="" id="submit_button">
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
                data.append('crud_id', '{{ $system_email->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  // var allEditors = document.querySelectorAll('.ckeditor');
  // for (var i = 0; i < allEditors.length; ++i) {
  //   ClassicEditor.create(
  //     allEditors[i], {
  //       extraPlugins: [SimpleUploadAdapter]
  //     }
  //   );
  // }
    //************************
    if($("#type").val()=="1"){
        $("#programmes_field").hide();
        $("#lectures_field").hide();
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
    $('#search_emails').click(function(){
        $('#search_emails').attr('disabled',true);
        var mail_type =$('#type').val();
        var name_id =$('#name_id').val();
        var program_id =$('#program_id').val();
        var lecture_id =$('#lecture_id').val();


        // if(val=='Refused'||val=='Pending'||val=='Withdrawal'){
        //     if($('#Reason').val()==''){
        //       return  alert('Please add a reason');
        //     }
        // }
        $.ajax({
            type:'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:'{{ route('admin.system-emails.search') }}',
            data:'mail_type='+mail_type+'&name_id= '+name_id+'&program_id='+program_id+'&lecture_id='+lecture_id,
            beforeSend: function(){
                $("#loader").show();
                $("#return_url").html(" ");
                // $("#return_url").hide();
                // return false;
            },
            success:function(data) {
                if(data){
                    var json = $.parseJSON(data);
                    if(json.existin_url){
                        $("#return_url").html("Another Email system meets your choices, you can edit it from this link: <a href='"+json.existin_url+"'>"+json.existin_url+"</a>");
                    }
                        
                    if(json.default_content){
                        $("#content_field").show();
                        tinymce.activeEditor.setContent(json.default_content);
                    }
                    if(json.default_subject){
                        $("#subject_field").show();
                        $("#subject").val(json.default_subject);
                    }

                }
                $("#loader").hide();
                $('#search_emails').attr('disabled',false);
                $('#submit_button').attr('disabled',false);
                return false;
            }
        });
    })

    //************************

});
</script>

@endsection