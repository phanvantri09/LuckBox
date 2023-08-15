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
        // box item này là nằm giữa event và box, nhiệm vụ và liên kết box cho event
        // ví dụ 1 event sẽ có 30 box khác nhau thì mỗi item là mỗi liê kết cho 1 box
        Schema::create('box_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user_create');
            $table->integer('id_user_update');
            $table->integer('id_box_event');
            $table->integer('id_box');
            $table->integer('status')->default(1)->comment('1 là đợi lên sàn, 2 đang trong thời gian bán 3 là hết thời gian bán');
            $table->integer('order_number')->nullable()->comment('số thứ tự nhưng chắc sẽ dùng time để xác định chứ k cần phải dùng order nên cứ để rỗng trước');
            $table->integer('amount')->comment('số lượng cho phép bán đi của Hộp box trong thời gian event này, nhớ kiểm tra để so sánh với số lượng còn lại trong kho');
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
