<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Address;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // For testing with a smaller dataset first
        $this->command->info('Creating test users...');
        // User::factory(10)
        //     ->has(Address::factory())
        //     ->create();

        $this->command->info('Starting to seed 1 million users...');
        $chunkSize = 10;
        $totalUsers = 1000000;
        
        for ($i = 0; $i < $totalUsers; $i += $chunkSize) {
            $this->command->info("Seeding users {$i} to " . min($i + $chunkSize, $totalUsers));
            User::factory($chunkSize)
                ->has(Address::factory())
                ->create();
        }
        
        $this->command->info('Finished seeding 1 million users!');
    }
}
