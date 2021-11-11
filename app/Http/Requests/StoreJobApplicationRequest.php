<?php

namespace App\Http\Requests;

use App\Models\JobApplication;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJobApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('job_application_create');
    }

    public function rules()
    {
        return [
            'job_id' => [
                'required',
                'integer',
            ],
            'first_name' => [
                'string',
                'required',
            ],
            'middle_name' => [
                'string',
                'nullable',
            ],
            'last_name' => [
                'string',
                'required',
            ],
            'birth_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'street_address' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'post_code' => [
                'string',
                'required',
            ],
            'email_address' => [
                'required',
            ],
            'phone_number_1' => [
                'string',
                'required',
            ],
            'phone_number_2' => [
                'string',
                'required',
            ],
            'linked_in_profile' => [
                'string',
                'required',
            ],
            'field_of_study' => [
                'string',
                'required',
            ],
            'institute' => [
                'string',
                'required',
            ],
            'country' => [
                'string',
                'required',
            ],
            'start_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'end_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'high_school_name' => [
                'string',
                'required',
            ],
            'certificate_type' => [
                'string',
                'required',
            ],
            'grade' => [
                'string',
                'required',
            ],
            'history_title' => [
                'string',
                'required',
            ],
            'history_type_of_institute' => [
                'string',
                'required',
            ],
            'history_city' => [
                'string',
                'required',
            ],
            'history_country' => [
                'string',
                'required',
            ],
            'history_start_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'history_end_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'history_reason_of_leaving' => [
                'required',
            ],
            'current_notice_period' => [
                'string',
                'required',
            ],
            'nationality' => [
                'string',
                'required',
            ],
            'race' => [
                'string',
                'required',
            ],
            'religion' => [
                'required',
            ],
            'disability_yes' => [
                'string',
                'nullable',
            ],
        ];
    }
}
