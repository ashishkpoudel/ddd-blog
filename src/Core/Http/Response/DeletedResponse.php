<?php

namespace src\Core\Http\Response;

use Illuminate\Http\JsonResponse;

final class DeletedResponse extends JsonResponse
{
    public function __construct(array $headers = [])
    {
        parent::__construct(null, 204, $headers);
    }
}
