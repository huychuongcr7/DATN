<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_code', 10)->unique();
            $table->string('name', 64)->unique();
            $table->string('email', 64)->unique()->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 15)->nullable();
            $table->integer('supplier_debt')->default(0);
            $table->unsignedTinyInteger('status');
            $table->string('company')->nullable();
            $table->bigInteger('tax_code')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
