<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOtherToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username',100)->comment('用户名');
            $table->string('email',100)->nullable()->change();
            $table->string('mobile',11)->default('')->comment('电话');
            $table->string('qq',20)->default('')->comment('qq');
            $table->string('wx',100)->default('')->comment('微信号');
            $table->timestamp('birthday')->nullable()->comment('出生日期');
            $table->timestamp('need_first_birth')->nullable()->comment('出生日期');
            $table->timestamp('need_last_birth')->nullable()->comment('出生日期');
            $table->tinyInteger('sex')->default(0)->comment('性别');
            $table->string('job',100)->default('')->comment('工作');
            $table->tinyInteger('marital_status')->default(0)->comment('hunyin情况');
            $table->string('portrait')->nullable()->comment('头像');
            $table->tinyInteger('status')->default(0)->comment('状态,1公开，2封号');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
