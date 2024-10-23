<?php

namespace App\Http\Controllers\V1\Services;

use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use Illuminate\Http\JsonResponse;

class IndexController
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        $services = Service::query()->cursorPaginate(config('app.pagination.limit'));
        return new JsonResponse(
            data: ServiceResource::collection(
                resource: $services),
            status: 200
        );
    }
}
