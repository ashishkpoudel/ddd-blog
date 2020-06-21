<?php

namespace Weblog\Posts\Infrastructure\Http\Requests;

use Weblog\Core\Http\Requests\BaseFormRequest;

final class PostRequest extends BaseFormRequest
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
