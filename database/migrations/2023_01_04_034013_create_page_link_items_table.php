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
        Schema::create('page_link_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_link_id');
            $table->string('title');
            $table->string('url');
            $table->integer('order')->default(1);
            $table->boolean('is_active')->default(1);
            $table->string('background_color')->nullable();
            $table->string('icon')->nullable();

            $table->foreign('page_link_id')->references('id')->on('page_links');
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
        Schema::dropIfExists('page_link_items');
    }
};
