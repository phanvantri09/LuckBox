<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_events', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_create');
            $table->integer('id_user_update');
            $table->integer('status')->default(1)->comment('1 là hoạt động, 2 là ngừng hoạt động');
            $table->string('title');
            $table->string('description');
            // $table->integer('price');
            // $table->integer('amount_box');
            $table->string('link_image');
            $table->string('time_start');
            $table->string('time_end');
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
        Schema::dropIfExists('box_events');
    }
}
