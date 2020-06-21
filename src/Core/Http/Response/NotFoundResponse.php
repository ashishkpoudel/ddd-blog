<?php

namespace Weblog\Core\Http\Response;

use Illuminate\Http\JsonResponse;

final class NotFoundResponse extends JsonResponse
{
    public function __construct(string $message, array $headers = [])
    {
        parent::__construct(['message' => $message], self::HTTP_NOT_FOUND, $headers);
    }
}
