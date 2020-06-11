<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse as BaseResponse;

class JsonResponse extends BaseResponse
{
    public function __construct($content = '', $status = 200, array $headers = [])
    {
        parent::__construct($content, $status, $headers);
    }
}
