<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFolowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('folows', function (Blueprint $table) {
            $table->id();
            $table->text('id_user');// list user , , , ,
            $table->bigInteger('id_box_item');
            $table->bigInteger('id_box_event');
            $table->bigInteger('id_box');
            $table->bigInteger('id_cart')->nullable();
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
        Schema::dropIfExists('folows');
    }
}
