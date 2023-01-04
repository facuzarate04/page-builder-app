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
        Schema::create('page_headers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('avatar_is_active')->default(1);
            $table->string('banner')->nullable();
            $table->boolean('banner_is_active')->default(1);

            $table->foreign('page_id')->references('id')->on('pages');
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
        Schema::dropIfExists('page_headers');
    }
};
