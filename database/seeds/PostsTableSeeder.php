<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Post::truncate();
        factory(Post::class, 5)->create();

        Schema::enableForeignKeyConstraints();
    }
}
