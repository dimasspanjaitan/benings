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
            $table->boolean('status')->default(1);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->integer('upline')->nullable();
            $table->string('phone');
            $table->string('instagram')->nullable();
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('gender');
            $table->string('sub_district');
            $table->string('city');
            $table->text('address');
            $table->string('bank_number')->nullable();
            $table->integer('level_id')->index();
            $table->integer('region_id')->index();
            $table->text('photo')->nullable();
            $table->text('id_card_photo')->nullable();
            $table->string('id_card_number')->nullable();
            $table->boolean('another_partner')->nullable();
            $table->integer('role');
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
