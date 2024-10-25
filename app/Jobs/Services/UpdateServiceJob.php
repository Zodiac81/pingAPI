<?php

namespace App\Jobs\Services;

use App\Http\Payloads\V1\CreateServicePayload;
use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

class UpdateServiceJob implements ShouldQueue
{
    use Queueable;

    /**
     * @param CreateServicePayload $payload
     */
    public function __construct(
        private readonly CreateServicePayload $payload,
        private readonly Service $service
    ){}

    /**
     * @param DatabaseManager $database
     * @return void
     * @throws \Throwable
     */
    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => $this->service->update(
                $this->payload->toArray(),
            ),
            attempts: 3)
        ;
    }
}
