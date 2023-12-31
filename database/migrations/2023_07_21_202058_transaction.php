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
            $table->string('card_number')->nullable();//
            $table->text('transaction_content')->nullable();// thông tin giao dịch
            $table->integer('status')->default(1)->comment("0 là mới tạo và chưa cập nhật thông tin tài khoản ck, 1 là vừa tạo đợi admin duyệt, 2 admin đã chấp nhận và thực hiện(Đối với thanh toán box thì oke lun), 3 admin từ chối");
            $table->bigInteger('id_cart')->nullable();
            $table->string('code')->nullable();
            $table->text('link_image')->nullable();
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
