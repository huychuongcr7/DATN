<?php

use App\Models\Trademark;
use Illuminate\Database\Seeder;

class TrademarksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Trademark::truncate();
        factory(Trademark::class, 10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
