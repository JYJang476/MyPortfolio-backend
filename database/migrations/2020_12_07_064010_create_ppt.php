<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ppt', function (Blueprint $table) {
            $table->id();
            $table->integer('img_id');
            $table->integer('ppt_no');
            $table->integer('board_id');
            $table->integer('project_id');
            $table->timestamp('ppt_date')->nullable(true)->useCurrent();
//            $table->foreign('project_id')->references('id')->on('project');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ppt');
    }
}
