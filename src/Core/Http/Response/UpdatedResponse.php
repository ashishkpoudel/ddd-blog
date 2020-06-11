<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

class UpdatedResponse extends JsonResponse
{
    public function __construct($content = '', array $headers = [])
    {
        parent::__construct($content, 200, $headers);
    }
}
