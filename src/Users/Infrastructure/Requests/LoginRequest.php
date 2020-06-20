<?php

namespace src\Users\Infrastructure\Requests;

use src\Core\Http\Requests\BaseFormRequest;

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
