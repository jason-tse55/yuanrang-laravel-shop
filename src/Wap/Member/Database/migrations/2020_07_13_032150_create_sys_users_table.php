<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSysUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sys_user', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('主键');
            $table->string('nick_name', 50)->default('')->comment('用户名');
            $table->string('password', 50)->default('')->comment('密码');
            $table->string('weixin_openid')->default('')->comment('微信公众号openid');
            $table->string('image_head')->default('')->comment('用户头像url');
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
        Schema::dropIfExists('sys_user');
        
    }
}
