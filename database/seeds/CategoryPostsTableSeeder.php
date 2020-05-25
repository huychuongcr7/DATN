<?php

use App\Models\CategoryPost;
use Illuminate\Database\Seeder;

class CategoryPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        CategoryPost::truncate();
        factory(CategoryPost::class, 5)->create();

        Schema::enableForeignKeyConstraints();
    }
}
