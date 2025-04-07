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
            'user_id' => User::where('email', 'admin@gmail.com')->first()->id,
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
            'user_id' => User::where('email', 'cuckoodile@gmail.com')->first()->id,
            'first_name' => 'Cuckoodile',
            'last_name' => 'Shurima',
        ]);

        // Create post: Frieren
        Post::create([
            'created_by' => User::where('username', 'admin')->first()->id,
            'description' => "Frieren Beyond Journey's End release date leaked!",
            'media_link' => 'https://www.youtube.com/watch?v=JHJfWdUNUQ8',
            // 'thumbnail_link' => 'https://scontent.fmnl31-1.fna.fbcdn.net/v/t1.15752-9/486553564_1167978871482807_2430809985889319971_n.png?_nc_cat=109&ccb=1-7&_nc_sid=0024fc&_nc_eui2=AeEsOTfv9ghdSc46n-bcg4hCKpjjKHvop-YqmOMoe-in5lLJ95Ldj0rei3e4DTjmxPn2G2TFhtvSP8W7HHbYOYeI&_nc_ohc=fAzkRpUDJnoQ7kNvgFU8yrV&_nc_oc=AdmMwPQKAT2ocIcyMwtn8VqAGC4rA0kX1LSqfBdtUCJYELZTfVfSM0-U4Qjz28GcqF8&_nc_ad=z-m&_nc_cid=0&_nc_zt=23&_nc_ht=scontent.fmnl31-1.fna&oh=03_Q7cD1wGNchS6w0fm_WxrPbLLTv3Mfpm4yLaTUg73SCy3O9a_NA&oe=68146BC8',
            'thumbnail_link' => '',
        ]);

        Artisan::call('passport:client --personal --no-interaction');
    }
}
