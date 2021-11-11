<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'name'               => [
                'string',
                'required',
            ],
            'email'              => [
                'required',
                'unique:users',
            ],
            'password'           => [
                'required',
            ],
            'roles.*'            => [
                'integer',
            ],
            'roles'              => [
                'required',
                'array',
            ],
            'program_id'            => [
                'required',
            ],
            'last_name'          => [
                'string',
                'min:3',
                'max:50',
                'required',
            ],
            'full_name_en'       => [
                'string',
                'min:10',
                'max:100',
                'required',
            ],
            'full_name_ar'       => [
                'string',
                'nullable',
            ],
            'personal_photo'     => [
                'required',
            ],
            'national'           => [
                'string',
                'min:5',
                'max:20',
                'required',
            ],
            'id_photo'           => [
                'required',
            ],
            'birth_date'         => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'phone'              => [
                'string',
                'required',
            ],
            'birth_country'      => [
                'string',
                'required',
            ],
            'country'            => [
                'string',
                'required',
            ],
            'state'              => [
                'string',
                'required',
            ],
            'linkedin'           => [
                'string',
                'nullable',
            ],
            'undergraduate'      => [
                'required',
            ],
            'degree'             => [
                'required',
            ],
            'degree_photo'       => [
                'required',
            ],
            'personal_statement' => [
                'string',
                'required',
            ],
            'know_us'            => [
                'required',
            ],
        ];
    }
}
