<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(10000)
        ->has(
            Post::factory()->count(rand(1, 20))
            ->has(Comment::factory()->count(rand(7, 15)))
        )
        ->create();
    }
}
