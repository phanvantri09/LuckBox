<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_create');
            $table->bigInteger('id_user_update');
            $table->string('bank');
            $table->string('card_name');
            $table->string('card_number');
            $table->string('card_branch');
            $table->integer('status')->default(0);
            $table->string('image_ql_code')->nullable();
            $table->integer('type')->default(111)->comment('dùng để phân biệt tài khoản: 111 là user, 222 là admin kiểu nhân viên, 333 là super admin ');
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
        Schema::dropIfExists('cards');
    }
}
