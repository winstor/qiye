<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('site_id');
            $table->string('type')->comment('类型');
            $table->string('title')->nullable()->comment('网站名称');
            $table->string('title2')->nullable()->comment('首页副标题');
            $table->string('keywords')->nullable()->comment('关键字');
            $table->string('description')->nullable()->comment('描述');
            $table->text('desc')->nullable()->comment('描述');
            $table->text('lx')->nullable()->comment('联系方式');
            $table->string('icp')->nullable()->comment('ICP备案证书号');
            $table->tinyInteger('per_page')->default(15)->comment('文章分页');
            $table->text('data')->comment('json数据');
            $table->string('logo')->nullable()->comment('logo');
            $table->string('favicon')->nullable()->comment('icon');
            $table->string('client_cert')->nullable()->comment('证书文件');
            $table->string('client_key')->nullable()->comment('证书密钥pem');

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
        Schema::dropIfExists('configs');
    }
}
