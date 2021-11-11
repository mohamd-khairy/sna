<?php

namespace App\Http\Requests;

use App\Models\Lecture;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLectureRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lecture_create');
    }

    public function rules()
    {
        return [
            'name'           => [
                'string',
                'required',
            ],
            'date'           => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time'           => [
                'required',
                'date_format:' . config('panel.time_format'),
            ],
            'instructor'     => [
                'string',
                'required',
            ],
            'price_forign'   => [
                'required',
            ],
            'price_egyption' => [
                'required',
            ],
        ];
    }
}
