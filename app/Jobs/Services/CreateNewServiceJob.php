<?php

namespace App\Jobs\Services;

use App\Http\Payloads\V1\CreateServicePayload;
use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

class CreateNewServiceJob implements ShouldQueue
{
    use Queueable;
    public function __construct(
        private readonly CreateServicePayload $payload
    ){}

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => Service::query()->create(
                $this->payload->toArray(),
            ),
            attempts: 3)
        ;
    }
}
