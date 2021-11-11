<?php

namespace App\Http\Requests;

use App\Models\UserLog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserLogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_log_edit');
    }

    public function rules()
    {
        return [
            'user_id'           => [
                'integer',
                'required',
            ],
            'log_message'           => [
                'string',
                'required',
            ],
        ];
    }
}
