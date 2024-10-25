<?php

namespace App\Http\Controllers\V1\Services;

use App\Http\Requests\V1\Services\WriteRequest;
use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\CreateNewServiceJob;
use App\Models\Service;
use Illuminate\Auth\Access\Gate;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final readonly class StoreController
{
    /**
     * @param Dispatcher $bus
     */
    public function __construct(
        private Dispatcher $bus
    )
    {
    }

    /**
     * @param WriteRequest $request
     * @return Response|Responsable
     */
    public function __invoke(WriteRequest $request): Response|Responsable
    {
        if(!Gate::allows('create', Service::class)){
           throw new UnauthorizedException(
               message: 'You must verify your email before creating a new service.',
               code: Response::HTTP_FORBIDDEN
           );
        }

        $this->bus->dispatch(
          command: new CreateNewServiceJob(
              $request->payload()
            )
        );

        return new MessageResponse(
            message: 'Your service has been created.',
            status: Response::HTTP_ACCEPTED
        );
    }
}
