<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Oleksii Derevianko',
            'email' => 'oleksii@gmail.com',
        ]);

        Service::factory()->for($user)->count(50)->create();
    }
}
