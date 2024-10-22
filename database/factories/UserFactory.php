<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class UserFactory extends Factory
{

    /**
     * @var class-string<Model>
     */
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array{name: string, email: string, password: string, remember_token: string, email_verified_at: \Illuminate\Support\Carbon}
     */
    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'password'          => Hash::make('password'),
            'remember_token'    => Str::random(10),
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): UserFactory
    {
        return $this->state(
            state: fn (array $attributes) => [
                'email_verified_at' => null,
                ]);
    }
}
