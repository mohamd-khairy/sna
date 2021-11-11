@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.blogscomment.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.blogscomments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.id') }}
                        </th>
                        <td>
                            {{ $blogscomment->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.blog') }}
                        </th>
                        <td>
                            {{ $blogscomment->blog->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.image') }}
                        </th>
                        <td>
                            @if($blogscomment->image)
                                <a href="{{ $blogscomment->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $blogscomment->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.comment') }}
                        </th>
                        <td>
                            {{ $blogscomment->comment }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.name') }}
                        </th>
                        <td>
                            {{ $blogscomment->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.email') }}
                        </th>
                        <td>
                            {{ $blogscomment->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.phone') }}
                        </th>
                        <td>
                            {{ $blogscomment->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.blogscomment.fields.approved') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $blogscomment->approved ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.blogscomments.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection