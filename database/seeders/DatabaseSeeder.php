<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\UserProfile;
use Illuminate\Database\Seeder;
use Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create user: Admin
        User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
        ]);
        UserProfile::create([
            'user_id' => User::where('username', 'admin')->first()->id,
            'first_name' => 'Admin',
            'last_name' => 'Admin',
        ]);

        // Create user: Cuckoodile
        User::factory()->create([
            'username' => 'cuckoodile',
            'email' => 'cuckoodile@gmail.com',
            'password' => bcrypt('123123123'),
        ]);
        UserProfile::create([
            'user_id' => User::where('username', 'cuckoodile')->first()->id,
            'first_name' => 'Cuckoodile',
            'last_name' => 'Shurima',
        ]);

        // Create post: Frieren
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Admin')->first()->id,
            'description' => "Frieren Beyond Journey's End release date leaked!",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        Artisan::call('passport:client --personal --no-interaction');
    }
}
