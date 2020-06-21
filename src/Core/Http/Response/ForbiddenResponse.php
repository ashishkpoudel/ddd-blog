<?php

namespace Weblog\Core\Http\Response;

use Illuminate\Http\JsonResponse;

final class ForbiddenResponse extends JsonResponse
{
    public function __construct(string $message, array $headers = [])
    {
        parent::__construct(['message' => $message], self::HTTP_FORBIDDEN, $headers);
    }
}
