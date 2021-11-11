@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.lecture.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lectures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.id') }}
                        </th>
                        <td>
                            {{ $lecture->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.name') }}
                        </th>
                        <td>
                            {{ $lecture->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.date') }}
                        </th>
                        <td>
                            {{ $lecture->date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.time') }}
                        </th>
                        <td>
                            {{ $lecture->time }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.instructor') }}
                        </th>
                        <td>
                            {{ $lecture->instructor }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.price_forign') }}
                        </th>
                        <td>
                            {{ $lecture->price_forign }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.price_egyption') }}
                        </th>
                        <td>
                            {{ $lecture->price_egyption }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.lecture.fields.description') }}
                        </th>
                        <td>
                            {!! $lecture->description !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.lectures.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection