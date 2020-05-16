<?php

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Customer::truncate();
        Customer::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('123456'),
            'status' => array_rand(Customer::$statuses),
            'gender' => array_rand(Customer::$genders),
        ]);
        factory(Customer::class, 50)->create();

        Schema::enableForeignKeyConstraints();
    }
}
