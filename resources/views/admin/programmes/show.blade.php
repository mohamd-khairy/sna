@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.programme.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.programmes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.programme.fields.id') }}
                        </th>
                        <td>
                            {{ $programme->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.programme.fields.name') }}
                        </th>
                        <td>
                            {{ $programme->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.programme.fields.price') }}
                        </th>
                        <td>
                            {{ $programme->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.programme.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $programme->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.programmes.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#program_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="program_users">
            @includeIf('admin.programmes.relationships.programUsers', ['users' => $programme->programUsers])
        </div>
    </div>
</div>

@endsection