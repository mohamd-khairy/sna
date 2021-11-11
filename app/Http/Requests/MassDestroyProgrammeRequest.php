<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Programme;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProgrammeRequest extends FormRequest  {





public function authorize()
{
    abort_if(Gate::denies('programme_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');




return true;

}
public function rules()
{




return [
'ids' => 'required|array',
    'ids.*' => 'exists:programmes,id',
];

}

}
