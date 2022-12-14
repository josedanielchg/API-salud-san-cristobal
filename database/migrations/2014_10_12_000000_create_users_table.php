<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone_home', 20);
            $table->string('phone_mobile', 20);
            $table->integer('personal_id')->unique();
            $table->string('address_1', 255);
            $table->string('address_2', 255)->nullable();
            $table->string('hospital', 255)->nullable();
            $table->boolean('admin')->default(0);
            $table->boolean('under_age')->default(0);
            $table->enum('disease', ['covid19', 'variante', 'viruela'])->nullable();

            $table->rememberToken();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
