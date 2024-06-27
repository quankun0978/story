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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("slug");
            $table->text("description");
            $table->text("image");
            $table->string("status");
            $table->text("author");
            $table->longText("content");
            $table->mediumText("link_pdf");
            $table->text("key_word");
            $table->dateTime("created_at");
            $table->dateTime("updated_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
