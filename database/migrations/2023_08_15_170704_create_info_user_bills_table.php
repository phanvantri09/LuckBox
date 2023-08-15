<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfoUserBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_user_bills', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('status')->default(0)->comment("0 là vừa tạo, 1 được chọn ưu tiên");
            $table->text('name');
            $table->text('number_phone');
            $table->text('address');
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
        Schema::dropIfExists('info_user_bills');
    }
}
