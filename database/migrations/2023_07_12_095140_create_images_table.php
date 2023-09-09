<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->integer('id_product');
            $table->string('link_image');
            $table->longText('description')->nullable();
            $table->integer('type')->nullable()->comment('1 là ưu tiên hiển thị, còn null hoặc bằng 0');
            $table->integer('is_slide')->nullable()->comment('nó là ảnh slide của sản phẩm, gia trị của nó sẽ là 1 ');
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
        Schema::dropIfExists('images');
    }
}
