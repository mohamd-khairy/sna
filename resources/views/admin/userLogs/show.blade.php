@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} Log
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.user_log.fields.id') }}
                        </th>
                        <td>
                            {{ $user_log->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.user_log.fields.user') }}
                        </th>
                        <td>
                            {{ $user_log->user->name }}
                        </td>
                    </tr>
                    
                    
                    <tr>
                        <th>
                            {{ trans('cruds.user_log.fields.message') }}
                        </th>
                        <td>
                            {!! $user_log->log_message !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-logs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection