<?php

namespace App\Http\Controllers\V1\Services;

use App\Http\Responses\V1\MessageResponse;
use App\Jobs\Services\DeleteServiceJob;
use App\Models\Service;
use Illuminate\Auth\Access\Gate;
use Illuminate\Bus\Dispatcher;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Request;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpFoundation\Response;

final readonly class DeleteController
{
    /**
     * @param Dispatcher $bus
     */
    public function __construct(
        private Dispatcher $bus
    ){}

    /**
     * @param Request $request
     * @param Service $service
     * @return Responsable
     */
    public function __invoke(Request $request, Service $service): Responsable
    {
        if(!Gate::allows('update', $service)){
            throw new UnauthorizedException(
                message: 'You are not able to delete service that you do not own',
                code: Response::HTTP_FORBIDDEN
            );
        }

        $this->bus->dispatch(
            command: new DeleteServiceJob(
               service: $service
            )
        );
        $service->delete();

        return new MessageResponse(
            message: 'Your service wil be deleted in the background.',
            status: Response::HTTP_ACCEPTED
        );
    }
}
