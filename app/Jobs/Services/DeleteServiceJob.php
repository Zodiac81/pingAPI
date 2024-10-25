<?php

namespace App\Jobs\Services;

use App\Models\Service;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\DatabaseManager;
use Illuminate\Foundation\Queue\Queueable;

final class DeleteServiceJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly Service $service
    ){}

    public function handle(DatabaseManager $database): void
    {
        $database->transaction(
            callback: fn() => $this->service->delete(),
            attempts: 3)
        ;
    }
}
