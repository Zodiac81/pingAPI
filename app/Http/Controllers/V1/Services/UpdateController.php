<?php

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\CreateNewServiceJob;
use App\Jobs\Services\UpdateServiceJob;
use App\Models\Service;
use Illuminate\Auth\Access\Gate;
use Illuminate\Bus\Dispatcher;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final readonly class UpdateController
{
    /**
     * @param Dispatcher $bus
     */
    public function __construct(
        private Dispatcher $bus
    )
    {
    }
    public function __invoke(WriteRequest $request, Service $service)
    {
        if(!Gate::allows('update', $service)){
            throw new UnauthorizedException(
                message: 'You are not able to update service that you do not own',
                code: Response::HTTP_FORBIDDEN
            );
        }

        $this->bus->dispatch(
            command: new UpdateServiceJob(
                $request->payload(),
                $service
            )
        );

        return new MessageResponse(
            message: 'Your service will be updated.',
            status: Response::HTTP_ACCEPTED
        );
    }
}
