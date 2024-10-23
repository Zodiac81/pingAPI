<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'      => $this->resource->id,
            'name'    => $this->resource->name,
            'url'     => $this->resource->url,
            'created' => new DateResource($this->resource->created_at),
        ];
    }
}
