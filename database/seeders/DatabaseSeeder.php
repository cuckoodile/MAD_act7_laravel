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

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "2nd test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "3rd test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://rb.gy/uvyd2r'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "4th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://th.bing.com/th/id/OIP.YmHd76i6ibxUxbIKIgqp_wHaEK?w=311&h=180&c=7&r=0&o=5&pid=1.7'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "5th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://th.bing.com/th/id/OIP.q_s3aYotYI18NDHyl_QCqwHaDt?w=342&h=174&c=7&r=0&o=5&pid=1.7'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "6th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://rb.gy/1qlxhg'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "7th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "8th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "9th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        // Create post: Test
        Post::create([
            'created_by' => UserProfile::where('first_name', 'Cuckoodile')->first()->id,
            'description' => "10th test",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            'thumbnail_link' => 'https://shorturl.at/SFppV'
        ]);

        Artisan::call('passport:client --personal --no-interaction');
    }
}
