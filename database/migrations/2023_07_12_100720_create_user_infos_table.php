<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('name')->nullable();
            $table->string('content')->nullable('Giới thiệu về user');
            $table->string('birthdate')->nullable();
            $table->string('number_phone')->nullable();
            // phần này là địa chỉ
            $table->string('house_number_street')->nullable()->comment('số nhà - đường');
            $table->string('neighborhood_village')->nullable()->comment('phường- xã');
            $table->string('district')->nullable()->comment('quận - huyện');
            $table->string('province_city')->nullable()->comment('tỉnh - Thành phố');
            $table->string('country')->nullable()->comment('Đất Nước');
            $table->string('link_image')->nullable()->comment('link hình ảnh trong storage');
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
        Schema::dropIfExists('user_infos');
    }
}
