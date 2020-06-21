<?php

namespace Weblog\Core\Http\Response;

use Illuminate\Http\JsonResponse;

final class OkResponse extends JsonResponse
{
    public function __construct($content = '', array $headers = [])
    {
        parent::__construct($content, self::HTTP_OK, $headers);
    }
}
