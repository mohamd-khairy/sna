@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jobApplication.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.job-applications.update", [$jobApplication->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="job_id">{{ trans('cruds.jobApplication.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id" required>
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('job_id') ? old('job_id') : $jobApplication->job->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.title') }}</label>
                <select class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" id="title">
                    <option value disabled {{ old('title', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\JobApplication::TITLE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('title', $jobApplication->title) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="first_name">{{ trans('cruds.jobApplication.fields.first_name') }}</label>
                <input class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text" name="first_name" id="first_name" value="{{ old('first_name', $jobApplication->first_name) }}" required>
                @if($errors->has('first_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.first_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="middle_name">{{ trans('cruds.jobApplication.fields.middle_name') }}</label>
                <input class="form-control {{ $errors->has('middle_name') ? 'is-invalid' : '' }}" type="text" name="middle_name" id="middle_name" value="{{ old('middle_name', $jobApplication->middle_name) }}">
                @if($errors->has('middle_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('middle_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.middle_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="last_name">{{ trans('cruds.jobApplication.fields.last_name') }}</label>
                <input class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text" name="last_name" id="last_name" value="{{ old('last_name', $jobApplication->last_name) }}" required>
                @if($errors->has('last_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.last_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birth_date">{{ trans('cruds.jobApplication.fields.birth_date') }}</label>
                <input class="form-control date {{ $errors->has('birth_date') ? 'is-invalid' : '' }}" type="text" name="birth_date" id="birth_date" value="{{ old('birth_date', $jobApplication->birth_date) }}">
                @if($errors->has('birth_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('birth_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.birth_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="street_address">{{ trans('cruds.jobApplication.fields.street_address') }}</label>
                <input class="form-control {{ $errors->has('street_address') ? 'is-invalid' : '' }}" type="text" name="street_address" id="street_address" value="{{ old('street_address', $jobApplication->street_address) }}" required>
                @if($errors->has('street_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('street_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.street_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="city">{{ trans('cruds.jobApplication.fields.city') }}</label>
                <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" id="city" value="{{ old('city', $jobApplication->city) }}" required>
                @if($errors->has('city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="post_code">{{ trans('cruds.jobApplication.fields.post_code') }}</label>
                <input class="form-control {{ $errors->has('post_code') ? 'is-invalid' : '' }}" type="text" name="post_code" id="post_code" value="{{ old('post_code', $jobApplication->post_code) }}" required>
                @if($errors->has('post_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('post_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.post_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_address">{{ trans('cruds.jobApplication.fields.email_address') }}</label>
                <input class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}" type="email" name="email_address" id="email_address" value="{{ old('email_address', $jobApplication->email_address) }}" required>
                @if($errors->has('email_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.email_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number_1">{{ trans('cruds.jobApplication.fields.phone_number_1') }}</label>
                <input class="form-control {{ $errors->has('phone_number_1') ? 'is-invalid' : '' }}" type="text" name="phone_number_1" id="phone_number_1" value="{{ old('phone_number_1', $jobApplication->phone_number_1) }}" required>
                @if($errors->has('phone_number_1'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number_1') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.phone_number_1_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number_2">{{ trans('cruds.jobApplication.fields.phone_number_2') }}</label>
                <input class="form-control {{ $errors->has('phone_number_2') ? 'is-invalid' : '' }}" type="text" name="phone_number_2" id="phone_number_2" value="{{ old('phone_number_2', $jobApplication->phone_number_2) }}" required>
                @if($errors->has('phone_number_2'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number_2') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.phone_number_2_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="linked_in_profile">{{ trans('cruds.jobApplication.fields.linked_in_profile') }}</label>
                <input class="form-control {{ $errors->has('linked_in_profile') ? 'is-invalid' : '' }}" type="text" name="linked_in_profile" id="linked_in_profile" value="{{ old('linked_in_profile', $jobApplication->linked_in_profile) }}" required>
                @if($errors->has('linked_in_profile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('linked_in_profile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.linked_in_profile_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.highest_degree') }}</label>
                @foreach(App\Models\JobApplication::HIGHEST_DEGREE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('highest_degree') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="highest_degree_{{ $key }}" name="highest_degree" value="{{ $key }}" {{ old('highest_degree', $jobApplication->highest_degree) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="highest_degree_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('highest_degree'))
                    <div class="invalid-feedback">
                        {{ $errors->first('highest_degree') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.highest_degree_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="field_of_study">{{ trans('cruds.jobApplication.fields.field_of_study') }}</label>
                <input class="form-control {{ $errors->has('field_of_study') ? 'is-invalid' : '' }}" type="text" name="field_of_study" id="field_of_study" value="{{ old('field_of_study', $jobApplication->field_of_study) }}" required>
                @if($errors->has('field_of_study'))
                    <div class="invalid-feedback">
                        {{ $errors->first('field_of_study') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.field_of_study_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="institute">{{ trans('cruds.jobApplication.fields.institute') }}</label>
                <input class="form-control {{ $errors->has('institute') ? 'is-invalid' : '' }}" type="text" name="institute" id="institute" value="{{ old('institute', $jobApplication->institute) }}" required>
                @if($errors->has('institute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('institute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.institute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="country">{{ trans('cruds.jobApplication.fields.country') }}</label>
                <input class="form-control {{ $errors->has('country') ? 'is-invalid' : '' }}" type="text" name="country" id="country" value="{{ old('country', $jobApplication->country) }}" required>
                @if($errors->has('country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.country_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="start_date">{{ trans('cruds.jobApplication.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="text" name="start_date" id="start_date" value="{{ old('start_date', $jobApplication->start_date) }}">
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_date">{{ trans('cruds.jobApplication.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="text" name="end_date" id="end_date" value="{{ old('end_date', $jobApplication->end_date) }}">
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="high_school_name">{{ trans('cruds.jobApplication.fields.high_school_name') }}</label>
                <input class="form-control {{ $errors->has('high_school_name') ? 'is-invalid' : '' }}" type="text" name="high_school_name" id="high_school_name" value="{{ old('high_school_name', $jobApplication->high_school_name) }}" required>
                @if($errors->has('high_school_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('high_school_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.high_school_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="certificate_type">{{ trans('cruds.jobApplication.fields.certificate_type') }}</label>
                <input class="form-control {{ $errors->has('certificate_type') ? 'is-invalid' : '' }}" type="text" name="certificate_type" id="certificate_type" value="{{ old('certificate_type', $jobApplication->certificate_type) }}" required>
                @if($errors->has('certificate_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('certificate_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.certificate_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="grade">{{ trans('cruds.jobApplication.fields.grade') }}</label>
                <input class="form-control {{ $errors->has('grade') ? 'is-invalid' : '' }}" type="text" name="grade" id="grade" value="{{ old('grade', $jobApplication->grade) }}" required>
                @if($errors->has('grade'))
                    <div class="invalid-feedback">
                        {{ $errors->first('grade') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.grade_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="comments">{{ trans('cruds.jobApplication.fields.comments') }}</label>
                <textarea class="form-control {{ $errors->has('comments') ? 'is-invalid' : '' }}" name="comments" id="comments">{{ old('comments', $jobApplication->comments) }}</textarea>
                @if($errors->has('comments'))
                    <div class="invalid-feedback">
                        {{ $errors->first('comments') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.comments_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_title">{{ trans('cruds.jobApplication.fields.history_title') }}</label>
                <input class="form-control {{ $errors->has('history_title') ? 'is-invalid' : '' }}" type="text" name="history_title" id="history_title" value="{{ old('history_title', $jobApplication->history_title) }}" required>
                @if($errors->has('history_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_type_of_institute">{{ trans('cruds.jobApplication.fields.history_type_of_institute') }}</label>
                <input class="form-control {{ $errors->has('history_type_of_institute') ? 'is-invalid' : '' }}" type="text" name="history_type_of_institute" id="history_type_of_institute" value="{{ old('history_type_of_institute', $jobApplication->history_type_of_institute) }}" required>
                @if($errors->has('history_type_of_institute'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_type_of_institute') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_type_of_institute_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_city">{{ trans('cruds.jobApplication.fields.history_city') }}</label>
                <input class="form-control {{ $errors->has('history_city') ? 'is-invalid' : '' }}" type="text" name="history_city" id="history_city" value="{{ old('history_city', $jobApplication->history_city) }}" required>
                @if($errors->has('history_city'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_city') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_city_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_country">{{ trans('cruds.jobApplication.fields.history_country') }}</label>
                <input class="form-control {{ $errors->has('history_country') ? 'is-invalid' : '' }}" type="text" name="history_country" id="history_country" value="{{ old('history_country', $jobApplication->history_country) }}" required>
                @if($errors->has('history_country'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_country') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_country_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_start_date">{{ trans('cruds.jobApplication.fields.history_start_date') }}</label>
                <input class="form-control date {{ $errors->has('history_start_date') ? 'is-invalid' : '' }}" type="text" name="history_start_date" id="history_start_date" value="{{ old('history_start_date', $jobApplication->history_start_date) }}" required>
                @if($errors->has('history_start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_end_date">{{ trans('cruds.jobApplication.fields.history_end_date') }}</label>
                <input class="form-control datetime {{ $errors->has('history_end_date') ? 'is-invalid' : '' }}" type="text" name="history_end_date" id="history_end_date" value="{{ old('history_end_date', $jobApplication->history_end_date) }}" required>
                @if($errors->has('history_end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="history_reason_of_leaving">{{ trans('cruds.jobApplication.fields.history_reason_of_leaving') }}</label>
                <textarea class="form-control {{ $errors->has('history_reason_of_leaving') ? 'is-invalid' : '' }}" name="history_reason_of_leaving" id="history_reason_of_leaving" required>{{ old('history_reason_of_leaving', $jobApplication->history_reason_of_leaving) }}</textarea>
                @if($errors->has('history_reason_of_leaving'))
                    <div class="invalid-feedback">
                        {{ $errors->first('history_reason_of_leaving') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.history_reason_of_leaving_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="current_notice_period">{{ trans('cruds.jobApplication.fields.current_notice_period') }}</label>
                <input class="form-control {{ $errors->has('current_notice_period') ? 'is-invalid' : '' }}" type="text" name="current_notice_period" id="current_notice_period" value="{{ old('current_notice_period', $jobApplication->current_notice_period) }}" required>
                @if($errors->has('current_notice_period'))
                    <div class="invalid-feedback">
                        {{ $errors->first('current_notice_period') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.current_notice_period_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="best_candidate">{{ trans('cruds.jobApplication.fields.best_candidate') }}</label>
                <textarea class="form-control {{ $errors->has('best_candidate') ? 'is-invalid' : '' }}" name="best_candidate" id="best_candidate">{{ old('best_candidate', $jobApplication->best_candidate) }}</textarea>
                @if($errors->has('best_candidate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('best_candidate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.best_candidate_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cv">{{ trans('cruds.jobApplication.fields.cv') }}</label>
                <div class="needsclick dropzone {{ $errors->has('cv') ? 'is-invalid' : '' }}" id="cv-dropzone">
                </div>
                @if($errors->has('cv'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cv') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.cv_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nationality">{{ trans('cruds.jobApplication.fields.nationality') }}</label>
                <input class="form-control {{ $errors->has('nationality') ? 'is-invalid' : '' }}" type="text" name="nationality" id="nationality" value="{{ old('nationality', $jobApplication->nationality) }}" required>
                @if($errors->has('nationality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nationality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.nationality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="race">{{ trans('cruds.jobApplication.fields.race') }}</label>
                <input class="form-control {{ $errors->has('race') ? 'is-invalid' : '' }}" type="text" name="race" id="race" value="{{ old('race', $jobApplication->race) }}" required>
                @if($errors->has('race'))
                    <div class="invalid-feedback">
                        {{ $errors->first('race') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.race_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.age_groups') }}</label>
                @foreach(App\Models\JobApplication::AGE_GROUPS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('age_groups') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="age_groups_{{ $key }}" name="age_groups" value="{{ $key }}" {{ old('age_groups', $jobApplication->age_groups) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="age_groups_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('age_groups'))
                    <div class="invalid-feedback">
                        {{ $errors->first('age_groups') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.age_groups_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.gender') }}</label>
                @foreach(App\Models\JobApplication::GENDER_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="gender_{{ $key }}" name="gender" value="{{ $key }}" {{ old('gender', $jobApplication->gender) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="gender_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('gender'))
                    <div class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.gender_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.jobApplication.fields.religion') }}</label>
                @foreach(App\Models\JobApplication::RELIGION_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('religion') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="religion_{{ $key }}" name="religion" value="{{ $key }}" {{ old('religion', $jobApplication->religion) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="religion_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('religion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('religion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.religion_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.disability') }}</label>
                @foreach(App\Models\JobApplication::DISABILITY_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('disability') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="disability_{{ $key }}" name="disability" value="{{ $key }}" {{ old('disability', $jobApplication->disability) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="disability_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('disability'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disability') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.disability_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="disability_yes">{{ trans('cruds.jobApplication.fields.disability_yes') }}</label>
                <input class="form-control {{ $errors->has('disability_yes') ? 'is-invalid' : '' }}" type="text" name="disability_yes" id="disability_yes" value="{{ old('disability_yes', $jobApplication->disability_yes) }}">
                @if($errors->has('disability_yes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('disability_yes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.disability_yes_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.jobApplication.fields.know_us') }}</label>
                @foreach(App\Models\JobApplication::KNOW_US_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('know_us') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="know_us_{{ $key }}" name="know_us" value="{{ $key }}" {{ old('know_us', $jobApplication->know_us) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="know_us_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('know_us'))
                    <div class="invalid-feedback">
                        {{ $errors->first('know_us') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.jobApplication.fields.know_us_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

@section('scripts')
<script>
    Dropzone.options.cvDropzone = {
    url: '{{ route('admin.job-applications.storeMedia') }}',
    maxFilesize: 7, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 7
    },
    success: function (file, response) {
      $('form').find('input[name="cv"]').remove()
      $('form').append('<input type="hidden" name="cv" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="cv"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($jobApplication) && $jobApplication->cv)
      var file = {!! json_encode($jobApplication->cv) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="cv" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection