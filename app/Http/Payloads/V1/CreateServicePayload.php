<?php

declare(strict_types=1);

namespace App\Http\Payloads\V1;

final readonly class CreateServicePayload
{
    /**
     * @param string $name
     * @param string $url
     * @param string $user
     */
    public function __construct(
        private string $name,
        private string $url,
        private string $user,
    ){}

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'url' => $this->url,
            'user_id' => $this->user,
        ];
    }
}
