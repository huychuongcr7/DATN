<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->unique();
            $table->string('email', 64)->unique();
            $table->string('password', 64);
            $table->string('address')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone', 15)->nullable();
            $table->tinyInteger('customer_type')->default(1);
            $table->tinyInteger('gender')->default(1);
            $table->string('avatar')->nullable();
            $table->string('facebook_url')->nullable();
            $table->text('note')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
