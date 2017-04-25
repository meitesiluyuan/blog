<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('member_list_id');
            $table->string('member_list_username')->default('')->comment('登录用户名');
            $table->char('member_list_pwd')->default('')->comment('登录密码');
            $table->char('member_list_salt')->default('')->comment('');
            $table->tinyInteger('member_list_groupid')->comment('所属会员组');
            $table->string('member_list_nickname')->default('')->comment('昵称');
            $table->integer('member_list_province')->comment('省/城市');
            $table->integer('member_list_city')->comment('市/县');
            $table->integer('member_list_town')->comment('乡/镇');
            $table->tinyInteger('member_list_sex')->default(3)->comment('1=男  2=女 3=保密');
            $table->string('member_list_headpic')->comment('会员头像路径');
            $table->string('member_list_tel')->comment('会员电话');
            $table->string('member_list_email')->comment('会员邮箱');
            $table->tinyInteger('member_list_open')->default(0)->comment('状态');
            $table->string('member_list_from')->comment('');
            $table->string('user_url')->comment('个人网站');
            $table->date('birthday')->comment('生日');
            $table->string('signature')->comment('签名');
            $table->string('last_login_ip')->comment('');
            $table->integer('last_login_time')->comment('');
            $table->integer('user_activation_key')->comment('激活验证');
            $table->tinyInteger('user_status')->default(0)->comment('0未激活 1激活');
            $table->integer('score')->default(0)->comment('积分');
            $table->integer('coin')->default(0)->comment('金币');
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
