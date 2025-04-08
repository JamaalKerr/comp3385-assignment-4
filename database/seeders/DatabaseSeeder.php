<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movie; // Import Movie model

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed test users
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed movies
        $movies = [
            ['title' => 'Sonic the Hedgehog 3', 'description' => 'Upcoming action-packed adventure.', 'poster' => 'images/sonic-the-hedgehog-3_2024.webp'],
            ['title' => 'Mufasa: The Lion King', 'description' => 'A journey into Mufasa\'s origin story.', 'poster' => 'images/mufasa-the-lion-king_2024.webp'],
            ['title' => 'Moana 2', 'description' => 'Moana embarks on another thrilling ocean adventure.', 'poster' => 'images/moana-2_2024.webp'],
            ['title' => 'Wicked', 'description' => 'The untold story of the witches of Oz.', 'poster' => 'images/wicked_2024.webp'],
            ['title' => 'Kraven the Hunter', 'description' => 'A dark Marvel tale following the infamous hunter.', 'poster' => 'images/kraven-the-hunter_2024.webp'],
        ];

        foreach ($movies as $movieData) {
            Movie::create($movieData);
        }
    }
}
