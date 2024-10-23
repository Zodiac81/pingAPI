<?php

namespace App\Http\Resources\V1;

use Carbon\CarbonInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @property CarbonInterface $resource */
class DateResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'human' => $this->resource->diffForHumans(),
            'string' => $this->resource->toDateTimeString(),
            'local' => $this->resource->toDateTimeLocalString(),
            'timestamp' => $this->resource->timestamp,
        ];
    }
}
