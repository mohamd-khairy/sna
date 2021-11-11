<?php

namespace App\Http\Requests;

use App\Models\Snippet;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySnippetRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('snippet_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:snippets,id',
        ];
    }
}
