<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CredentialType;
use App\Models\Credential;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

final class CredentialFactory extends Factory
{
    /**
     * @var class-string<Model>
     */
    protected $model = Credential::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
            'value' => $this->faker->uuid(),
            'type' => [
                'type' => CredentialType::BEARER_AUTH,
                'prefix' => 'Bearer'
            ],
            'user_id' => User::factory(),
        ];
    }
}
