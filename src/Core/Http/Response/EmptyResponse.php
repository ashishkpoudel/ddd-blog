<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

class EmptyResponse extends JsonResponse
{
    public function __construct(int $status = 200, array $headers = [])
    {
        parent::__construct(null, $status, $headers);
    }
}
