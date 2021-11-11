<?php

namespace App\Http\Requests;

use App\Models\Snippet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSnippetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('snippet_edit');
    }

    public function rules()
    {
        return [
            'slug' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:snippets,slug,' . request()->route('snippet')->id,
            ],
            'content_ar' => [
                'required',
            ],
            'content_en' => [
                'required',
            ],
        ];
    }
}
