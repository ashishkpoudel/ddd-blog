<?php

namespace Weblog\Core\Http\Response;

use Illuminate\Http\JsonResponse;

final class UpdatedResponse extends JsonResponse
{
    public function __construct($content = '', array $headers = [])
    {
        parent::__construct($content, 200, $headers);
    }
}
