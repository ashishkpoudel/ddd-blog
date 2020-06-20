<?php

namespace src\Posts\Infrastructure\Http\Requests;

use src\Core\Http\Requests\BaseFormRequest;

class PostRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'body' => ['required', 'string'],
            'tagIds' => ['array'],
        ];
    }
}
