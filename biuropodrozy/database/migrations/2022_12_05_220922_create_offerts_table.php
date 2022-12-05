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
        if (!Schema::hasTable('offerts')) {
            Schema::create('offerts', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->string('country');
                $table->string('title');
                $table->string('description')->nullable();
                $table->date('startdateturnus');
                $table->date('enddateturnus');
                $table->decimal('price', 10, 2);
                $table->date('startdate');
                $table->date('enddate');
                // $table->enum('status', ['Nie rozpoczęto','W trakcie','Zakończono'])->default('Nie rozpoczęto');
                $table->timestamps();
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
        Schema::dropIfExists('offerts');
    }
};