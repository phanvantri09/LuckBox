<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user');
            $table->bigInteger('id_admin_accept')->nullable();
            $table->bigInteger('type'); // get từ ConstCommon::TypeTransaction
            $table->bigInteger('total');// số tiền giao dịch
            $table->string('bank')->nullable();// tên ngân hàng
            $table->string('card_name')->nullable();// tên chủ thẻ
            $table->integer('card_number')->nullable();//
            $table->integer('transaction_content')->nullable();// thông tin giao dịch
            $table->integer('status')->default(1)->comment("1 là vừa tạo đợi admin duyệt, 2 admin đã chấp nhận và thực hiện, 3 admin từ chối");
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
        //
    }
}
