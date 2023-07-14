<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_products', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_create');
            $table->integer('id_user_update');
            $table->integer('id_box');
            $table->integer('id_product');
            $table->integer('status')->default('2')->comment('2 trạng thái: 1 được chọn hiển thị và 2 là không hiển thị');
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
        Schema::dropIfExists('box_products');
    }
}
