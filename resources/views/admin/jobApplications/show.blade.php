@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.jobApplication.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-applications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.id') }}
                        </th>
                        <td>
                            {{ $jobApplication->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.job') }}
                        </th>
                        <td>
                            {{ $jobApplication->job->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.title') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::TITLE_SELECT[$jobApplication->title] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.first_name') }}
                        </th>
                        <td>
                            {{ $jobApplication->first_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.middle_name') }}
                        </th>
                        <td>
                            {{ $jobApplication->middle_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.last_name') }}
                        </th>
                        <td>
                            {{ $jobApplication->last_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.birth_date') }}
                        </th>
                        <td>
                            {{ $jobApplication->birth_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.street_address') }}
                        </th>
                        <td>
                            {{ $jobApplication->street_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.city') }}
                        </th>
                        <td>
                            {{ $jobApplication->city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.post_code') }}
                        </th>
                        <td>
                            {{ $jobApplication->post_code }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.email_address') }}
                        </th>
                        <td>
                            {{ $jobApplication->email_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.phone_number_1') }}
                        </th>
                        <td>
                            {{ $jobApplication->phone_number_1 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.phone_number_2') }}
                        </th>
                        <td>
                            {{ $jobApplication->phone_number_2 }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.linked_in_profile') }}
                        </th>
                        <td>
                            {{ $jobApplication->linked_in_profile }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.highest_degree') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::HIGHEST_DEGREE_RADIO[$jobApplication->highest_degree] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.field_of_study') }}
                        </th>
                        <td>
                            {{ $jobApplication->field_of_study }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.institute') }}
                        </th>
                        <td>
                            {{ $jobApplication->institute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.country') }}
                        </th>
                        <td>
                            {{ $jobApplication->country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.start_date') }}
                        </th>
                        <td>
                            {{ $jobApplication->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.end_date') }}
                        </th>
                        <td>
                            {{ $jobApplication->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.high_school_name') }}
                        </th>
                        <td>
                            {{ $jobApplication->high_school_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.certificate_type') }}
                        </th>
                        <td>
                            {{ $jobApplication->certificate_type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.grade') }}
                        </th>
                        <td>
                            {{ $jobApplication->grade }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.comments') }}
                        </th>
                        <td>
                            {{ $jobApplication->comments }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_title') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_type_of_institute') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_type_of_institute }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_city') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_city }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_country') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_country }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_start_date') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_end_date') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.history_reason_of_leaving') }}
                        </th>
                        <td>
                            {{ $jobApplication->history_reason_of_leaving }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.current_notice_period') }}
                        </th>
                        <td>
                            {{ $jobApplication->current_notice_period }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.best_candidate') }}
                        </th>
                        <td>
                            {{ $jobApplication->best_candidate }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.cv') }}
                        </th>
                        <td>
                            @if($jobApplication->cv)
                                <a href="{{ $jobApplication->cv->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.nationality') }}
                        </th>
                        <td>
                            {{ $jobApplication->nationality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.race') }}
                        </th>
                        <td>
                            {{ $jobApplication->race }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.age_groups') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::AGE_GROUPS_RADIO[$jobApplication->age_groups] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.gender') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::GENDER_RADIO[$jobApplication->gender] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.religion') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::RELIGION_RADIO[$jobApplication->religion] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.disability') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::DISABILITY_RADIO[$jobApplication->disability] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.disability_yes') }}
                        </th>
                        <td>
                            {{ $jobApplication->disability_yes }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.jobApplication.fields.know_us') }}
                        </th>
                        <td>
                            {{ App\Models\JobApplication::KNOW_US_RADIO[$jobApplication->know_us] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.job-applications.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection