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
                $table->boolean('last_minute')->default(false); //czy oferta jest last minute
                $table->boolean('promotion')->default(false);
                $table->decimal('promotion_price', 10, 2)->nullable(); //cena promocyjna
                $table->decimal('insurance_price', 10, 2)->nullable(); //cena z ubezbieczniem zdrowotnym
                $table->string('region');
                $table->string('city');
                $table->boolean('all_inclusive')->default(false);
                $table->string('all_inclusive_desc')->nullable(); //opis all inclusive
                $table->string('place_desc')->nullable(); //opis położenia
                $table->string('what_in_price')->nullable(); //co w cenie
                $table->string('hotel_desc')->nullable(); //opis hotelu
                $table->string('rooms_desc')->nullable(); //opis pokoi
                $table->integer('people_num'); //ile osób
                $table->integer('nights_num'); //ile nocy
                $table->string('disabled_people_desc')->nullable(); //udogodnienia dla niepełnosprawnych
                $table->string('hotel_email');
                $table->unsignedBigInteger('hotel_tel');
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