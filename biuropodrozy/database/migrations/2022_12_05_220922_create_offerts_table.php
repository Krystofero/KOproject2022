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
                $table->boolean('lastminute')->default(false); //czy oferta jest last minute
                $table->boolean('promotion')->default(false);
                $table->decimal('promotionprice', 10, 2)->nullable(); //cena promocyjna
                $table->decimal('insuranceprice', 10, 2)->nullable(); //cena z ubezbieczniem zdrowotnym
                $table->string('region');
                $table->string('city');
                $table->boolean('allinclusive')->default(false);
                $table->string('allindescription')->nullable(); //opis all inclusive
                $table->string('placedescription')->nullable(); //opis położenia
                $table->string('pricedescription')->nullable(); //co w cenie
                $table->string('hoteldescription')->nullable(); //opis hotelu
                $table->string('roomsdescription')->nullable(); //opis pokoi
                $table->integer('persnum'); //ile osób
                $table->integer('nights'); //ile nocy
                $table->string('disdescription')->nullable(); //udogodnienia dla niepełnosprawnych
                $table->string('hemail');
                $table->unsignedBigInteger('htel');
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