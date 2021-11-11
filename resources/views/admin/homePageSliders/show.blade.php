@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.homePageSlider.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-page-sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.homePageSlider.fields.id') }}
                        </th>
                        <td>
                            {{ $homePageSlider->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homePageSlider.fields.title') }}
                        </th>
                        <td>
                            {{ $homePageSlider->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homePageSlider.fields.content_ar') }}
                        </th>
                        <td>
                            {!! $homePageSlider->content_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.homePageSlider.fields.content_en') }}
                        </th>
                        <td>
                            {!! $homePageSlider->content_en !!}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.home-page-sliders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection