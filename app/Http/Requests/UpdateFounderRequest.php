<?php

namespace App\Http\Requests;

use App\Models\Founder;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFounderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('founder_edit');
    }

    public function rules()
    {
        return [
            'name_ar' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'name_en' => [
                'string',
                'min:2',
                'max:50',
                'required',
            ],
            'title_ar' => [
                'string',
                'min:5',
                'max:50',
                'nullable',
            ],
            'title_en' => [
                'string',
                'min:5',
                'max:50',
                'nullable',
            ],
            'description_ar' => [
                'required',
            ],
            'description_en' => [
                'required',
            ],
            'department' => [
                'required',
            ],
        ];
    }
}
