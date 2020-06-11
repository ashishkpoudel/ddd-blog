<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

class CreatedResponse extends JsonResponse
{
    public function __construct($content = '', array $headers = [])
    {
        parent::__construct($content, 201, $headers);
    }
}
