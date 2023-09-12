<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('number_phone')->unique()->nullable();
            $table->string('code')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('type')->default(111)->comment('dùng để phân biệt tài khoản: 111 là user, 222 là admin kiểu nhân viên, 333 là super admin ');
            $table->integer('status')->default(1)->comment('dùng để xác định trạng thái tài khoản: 1 là được sử dụng, 2 là bị chặn ');
            $table->string('social_id')->nullable()->comment('láy id của nền tảng đăng ký: mail, facebook');
            $table->string('social_type')->nullable()->comment('2 loại là mail và facebook => chỉ cần lưu là google hoặc facebook');
            $table->bigInteger('id_user_referral')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
