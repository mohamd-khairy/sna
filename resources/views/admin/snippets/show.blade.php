@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.snippet.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.snippets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.snippet.fields.id') }}
                        </th>
                        <td>
                            {{ $snippet->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.snippet.fields.slug') }}
                        </th>
                        <td>
                            {{ $snippet->slug }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.snippet.fields.content_ar') }}
                        </th>
                        <td>
                            {!! $snippet->content_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.snippet.fields.content_en') }}
                        </th>
                        <td>
                            {!! $snippet->content_en !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.snippets.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection