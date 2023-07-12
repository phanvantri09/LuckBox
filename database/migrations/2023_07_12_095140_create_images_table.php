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
            $table->integer('id_foreign')->comment('dùng chung cho bảng user và product => khi get ra thì cần phải check điều kiện id_foreign này và type thì mới get nhá ');
            $table->string('link');
            $table->string('description')->nullable();
            $table->integer('type')->default(1)->comment('1 là product, 2 là user');
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
