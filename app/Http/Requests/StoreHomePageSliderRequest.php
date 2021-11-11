<?php

namespace App\Http\Requests;

use App\Models\HomePageSlider;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHomePageSliderRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('home_page_slider_create');
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
