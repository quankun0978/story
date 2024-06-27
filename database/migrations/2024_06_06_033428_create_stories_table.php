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
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->text("description");
            $table->enum("status",['active','inactive']);
            $table->unsignedBigInteger("category_id");
            $table->text("image");
            $table->text("author");
            $table->text("key_word");
            $table->string("type_id");
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
            $table->foreign("type_id")->references('id')->on('types')->onDelete('cascade');
            $table->foreign("category_id")->references('id')->on('categories')->onDelete('cascade');});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
};
