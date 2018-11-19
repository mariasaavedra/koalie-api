<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_role_user');
    }
}
