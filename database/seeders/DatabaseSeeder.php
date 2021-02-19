<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // $user = \App\Models\User::factory()
        //     ->has(\App\Models\Article::factory()->count(10))
        //     ->create();

        $posts = Article::factory()
            ->count(10)
            ->for(User::factory()->state([
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('12345678'),
            ]))
            ->create();

        // \App\Models\Article::factory(10)->create();
        \App\Models\Tag::factory(20)->create();
        $tags = Tag::all();
        Article::all()->each(function ($article) use ($tags) { 
            $article->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()); 
        });
    }
}
