<?php

namespace App\Http\Requests;

use App\Models\SystemEmail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSystemEmailRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('system_email_create');
    }

    public function rules()
    {
        return [
            // 'name'           => [
            //     'string',
            //     'required',
            // ],
            // 'slug'           => [
            //     'string',
            //     'required',
            // ],
            'subject'           => [
                'string',
                'required',
            ],
            'message'           => [
                'string',
                'required',
            ],
        ];
    }
}
