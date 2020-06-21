<?php

namespace Weblog\Users\Infrastructure\Requests;

use Weblog\Core\Http\Requests\BaseFormRequest;

final class LoginRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'emailAddress' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}
