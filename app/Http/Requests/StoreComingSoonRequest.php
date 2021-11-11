<?php

namespace App\Http\Requests;

use App\Models\ComingSoon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreComingSoonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('coming_soon_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
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
