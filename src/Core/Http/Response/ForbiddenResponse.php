<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

class ForbiddenResponse extends JsonResponse
{
    public function __construct(string $message, array $headers = [])
    {
        parent::__construct(['message' => $message], self::HTTP_FORBIDDEN, $headers);
    }
}
