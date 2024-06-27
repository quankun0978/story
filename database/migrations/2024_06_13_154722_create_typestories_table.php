<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_stories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("story_id");
            $table->unsignedBigInteger("type_id");
            $table->foreign("type_id")->references('id')->on('types')->onDelete('cascade');
            $table->foreign("story_id")->references('id')->on('stories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typestories');
    }
};
