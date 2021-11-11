<?php

namespace App\Http\Requests;

use App\Models\Blogscomment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBlogscommentRequest extends FormRequest
{
    public function authorize()
    {
        $ss = \Request::route()->getPrefix();
        if($ss=="/admin"){
            return Gate::allows('blogscomment_create');
        }else{
            return true;
        }
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
