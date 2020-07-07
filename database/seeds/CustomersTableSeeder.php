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
            'status' => Customer::STATUS_ACTIVE,
            'gender' => array_rand(Customer::$genders),
            'phone' => '0326175823'
        ]);
        factory(Customer::class, 10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
