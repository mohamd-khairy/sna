<?php

namespace App\Http\Requests;

use App\Models\Snippet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSnippetRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('snippet_create');
    }

    public function rules()
    {
        return [
            'slug' => [
                'string',
                'min:5',
                'max:50',
                'required',
                'unique:snippets',
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
