<?php

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Supplier::truncate();
        factory(Supplier::class, 10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
