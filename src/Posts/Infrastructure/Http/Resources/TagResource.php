<?php

namespace Weblog\Posts\Infrastructure\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Weblog\Posts\Domain\QueryResults\Tag as TagResult;

final class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var TagResult $data */
        $data = $this;

        return [
            'id' => $data->getId()->getValue(),
            'name' => $data->getName(),
        ];
    }
}
