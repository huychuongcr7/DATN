<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        User::truncate();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'status' => User::STATUS_ACTIVE,
            'gender' => array_rand(User::$genders),
            'role' => User::ROLE_ADMIN
        ]);

        User::create([
            'name' => 'Shipper',
            'email' => 'shipper@gmail.com',
            'password' => bcrypt('123456'),
            'status' => User::STATUS_ACTIVE,
            'gender' => array_rand(User::$genders),
            'role' => User::ROLE_SHIPPER
        ]);

        User::create([
            'name' => 'Stocker',
            'email' => 'stocker@gmail.com',
            'password' => bcrypt('123456'),
            'status' => User::STATUS_ACTIVE,
            'gender' => array_rand(User::$genders),
            'role' => User::ROLE_STOCKER
        ]);

        factory(User::class, 10)->create();

        Schema::enableForeignKeyConstraints();
    }
}
