<?php

namespace App\Http\Requests;

use App\Models\SystemEmail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySystemEmailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('system_email_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:system_emails,id',
        ];
    }
}
