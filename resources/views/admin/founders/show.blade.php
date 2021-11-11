@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.founder.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.founders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.id') }}
                        </th>
                        <td>
                            {{ $founder->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.name_ar') }}
                        </th>
                        <td>
                            {{ $founder->name_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.name_en') }}
                        </th>
                        <td>
                            {{ $founder->name_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.title_ar') }}
                        </th>
                        <td>
                            {{ $founder->title_ar }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.title_en') }}
                        </th>
                        <td>
                            {{ $founder->title_en }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.description_ar') }}
                        </th>
                        <td>
                            {!! $founder->description_ar !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.description_en') }}
                        </th>
                        <td>
                            {!! $founder->description_en !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.image') }}
                        </th>
                        <td>
                            @if($founder->image)
                                <a href="{{ $founder->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $founder->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.founder.fields.department') }}
                        </th>
                        <td>
                            {{ App\Models\Founder::DEPARTMENT_SELECT[$founder->department] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.founders.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection