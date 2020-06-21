<?php

namespace Weblog\Core\Http\Response;

use Illuminate\Http\JsonResponse as BaseResponse;

final class JsonResponse extends BaseResponse
{
    public function __construct($content = '', $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
    }
}
