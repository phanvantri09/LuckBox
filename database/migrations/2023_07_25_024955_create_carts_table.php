<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user_create');
            $table->bigInteger('id_admin_update')->nullable();
            $table->bigInteger('id_box_item');
            $table->bigInteger('id_box_event');
            $table->bigInteger('id_box');
            $table->bigInteger('id_folow')->nullable();
            $table->bigInteger('id_cart_old')->nullable();
            $table->bigInteger('status')->default(1);
            //  1 vừa thêm vào và chưa thanh toán, 2 đã thanh toán chưa mở Hộp,
            // 10 đăng bán lại
            // 11 f 30
            // 3 đã mở Hộp chưa được user xác nhận, 7 đã xác nhận giao hàng
            // 4 admin duyệt đơn để giao hàng, 5 đã giao thành công. 6 bị từ chối
            $table->bigInteger('amount');
            $table->bigInteger('price_cart')->nullable();
            $table->bigInteger('order_number')->nullable();
            $table->bigInteger('id_product_choese')->nullable();
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
        Schema::dropIfExists('carts');
    }
}
