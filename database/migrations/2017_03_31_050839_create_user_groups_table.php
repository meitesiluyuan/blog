<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->increments('user_group_id');
            $table->string('user_group_name')->default('')->comment('分组名称');
            $table->integer('user_group_open')->default(0)->comment('会员组是否开放');
            $table->integer('user_group_toplimit')->default(0)->comment('积分上限');
            $table->integer('user_group_bomlimit')->default(0)->comment('积分下限');
            $table->integer('user_group_order')->default(0)->comment('排序');
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
        Schema::dropIfExists('user_groups');
    }
}
