<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('box_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_create');
            $table->integer('id_user_update');
            $table->integer('status')->default(1)->comment('1 là đợi và lên sàn để bán, 2 là hết hạng rồi, 3 là người dùng đã mở box và thanh toán');
            $table->integer('order_number')->nullable()->comment('số thứ tự nhưng chắc sẽ dùng time để xác định chứ k cần phải dùng order nên cứ để rỗng trước');
            $table->integer('amount')->comment('số lượng bán đi của họp box trong thời gian event này');
            $table->integer('price')->comment('số tiền cho 1 box_item này');
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
        Schema::dropIfExists('box_items');
    }
}
