<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ToDo;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->has(ToDo::factory()->count(3))
            ->create();

        User::factory()
            ->count(5)
            ->has(ToDo::factory()->completed()->count(3))
            ->create();

        User::factory()
            ->has(ToDo::factory()->completed()->count(3))
            ->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
    }
}
