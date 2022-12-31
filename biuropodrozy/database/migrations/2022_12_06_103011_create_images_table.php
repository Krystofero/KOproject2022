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
        if (!Schema::hasTable('images')) {
            Schema::create('images', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('offert_id');
                $table->string('url');
                $table->boolean('is_main'); //definiuje czy zdjęcie ma być wyświetlane jako główne(profilowe) zdjęcie danej oferty
                $table->timestamps();
                $table->foreign('offert_id')->references('id')->on('offerts')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};