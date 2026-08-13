<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat 3 user
        $users = User::factory(3)->create();

        // Buat 5 post
        $posts = Post::factory(5)->create([
            'user_id' => $users->random()->id,
        ]);

        // Buat beberapa komentar acak
        foreach ($posts as $post) {
            Comment::factory(rand(2, 4))->create([
                'post_id' => $post->id,
                'user_id' => $users->random()->id,
            ]);
        }
    }
}

