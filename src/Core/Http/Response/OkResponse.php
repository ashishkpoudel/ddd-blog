<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

class OkResponse extends JsonResponse
{
    public function __construct($content = '', array $headers = [])
    {
        parent::__construct($content, self::HTTP_OK, $headers);
    }
}
