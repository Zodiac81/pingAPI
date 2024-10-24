<?php

declare(strict_types=1);

namespace App\Factories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use JustSteveKing\Tools\Http\Enums\Status;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Treblle\ApiResponses\Data\ApiError;
use Treblle\ApiResponses\Responses\ErrorResponse;

class ErrorFactory
{
    public static function create(\Throwable $exception, Request $request): ErrorResponse
    {
        return match ($exception::class) {

            NotFoundHttpException::class,
            ModelNotFoundException::class => new ErrorResponse(
                data: new ApiError(
                    title: 'Resource not found.',
                    detail: 'The requested resource was not found.',
                    instance: $request->fullUrl(),
                    code: '404'
                ),
                status: Status::INTERNAL_SERVER_ERROR
            ),
            default => new ErrorResponse(
                data: new ApiError(
                    title: 'Something went wrong',
                    detail: 'Something went wrong',
                    instance: $request->fullUrl(),
                    code: '500',
                ),
                status: Status::INTERNAL_SERVER_ERROR
            )
        };
    }
}
