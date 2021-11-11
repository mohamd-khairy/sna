<?php

namespace App\Http\Requests;

use App\Models\ComingSoon;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyComingSoonRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('coming_soon_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:coming_soons,id',
        ];
    }
}
