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
        Schema::create('page_social_links', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_social_id');
            $table->unsignedBigInteger('platform_id');
            $table->string('username');

            $table->foreign('page_social_id')->references('id')->on('page_socials');
            $table->foreign('platform_id')->references('id')->on('platforms');
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
        Schema::dropIfExists('page_social_links');
    }
};
