<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AddTestUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('users')->insert(
            array(
                'user_level' => 'Admin',
                'firstname' => 'Tester',
                'lastname' => 'Test',
                'email' => 'tester@test.com',
                'tel' => '186767467',
                'password' => Hash::make('tester12345'),
                'remember_token' => 'testertest123'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
