<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_create');
            $table->bigInteger('id_admin_update');
            $table->bigInteger('id_cart');
            $table->bigInteger('id_transaction');
            $table->bigInteger('id_box_item');
            $table->bigInteger('id_box_event');
            $table->bigInteger('id_box');
            $table->bigInteger('status')->default(1);// 1 vừa thêm vào và chưa thanh toán, 2 đã thanh toán chưa mở họp, 3 đã mở họp, 4 admin duyệt đơn để giao hàng, 5 đã giao thành công.
            $table->bigInteger('amount');
            $table->bigInteger('total');
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
        Schema::dropIfExists('bills');
    }
}
