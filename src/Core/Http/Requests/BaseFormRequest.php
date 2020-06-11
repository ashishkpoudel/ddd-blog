<?php

namespace src\Core\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
}
