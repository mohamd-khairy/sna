@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.system_email.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.system-emails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.system_email.fields.id') }}
                        </th>
                        <td>
                            {{ $system_email->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.system_email.fields.name') }}
                        </th>
                        <td>
                            {{ $system_email->name }}
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th>
                            {{ trans('cruds.system_email.fields.message') }}
                        </th>
                        <td>
                            {!! $system_email->message !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.system-emails.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection