<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('site_id')->default(0);
            $table->integer('category_id');
            $table->string('keywords')->nullable();
            $table->string('author')->nullable()->comment('作者');
            $table->string('from')->nullable()->comment('来源');
            $table->tinyInteger('is_top')->default(0)->comment('置顶');
            $table->tinyInteger('is_hot')->default(0)->comment('推荐');
            $table->integer('hits')->default(1)->comment('点击数');
            $table->string('note')->nullable()->comment('摘要');
            $table->string('img')->nullable('缩略图');
            $table->tinyInteger('is_img')->default(0)->comment('是否使用缩略图');
            $table->text('content');
            $table->timestamps();
            $table->index('site_id');
            $table->index('cat_id');
            $table->index('is_top');
            $table->index('is_hot');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
