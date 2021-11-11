<?php

namespace App\Http\Requests;

use App\Models\Blogscomment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBlogscommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blogscomment_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
        ];
    }
}
