<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address');
            $table->string('phone');
            $table->string('id_no');
            $table->string('id_type');
            $table->string('curr_city');
            $table->string('curr_pincode');
            $table->boolean('is_onduty');
            $table->boolean('is_available');
            $table->integer('amount');
            $table->double('lat', 15, 8);
            $table->double('long', 15, 8);            
            //$table->rememberToken();
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
        Schema::dropIfExists('user_drivers');
    }
}
