<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->integer('parent_id')->default(0);
            $table->integer('site_id')->default(0);
            $table->string('desc')->nullable();
            $table->string('logo')->nullable();
            $table->tinyInteger('is_index')->default(0)->comment('首页显示');
            $table->smallInteger('index_order')->default(10)->comment('首页排序');
            $table->tinyInteger('is_menu')->default(1)->comment('导航显示');
            $table->smallInteger('order')->default(10)->comment('导航排序');
            $table->timestamps();
            $table->index('site_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
