<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');//TODO: add forien key
            $table->string('curr_city');
            $table->string('curr_pincode');
            $table->boolean('is_onduty');
            $table->boolean('is_available');
            $table->integer('amount');
            $table->double('lat', 15, 8);
            $table->integer('lat_int');
            $table->double('long', 15, 8);
            $table->integer('long_int');
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
        Schema::dropIfExists('drivers');
    }
}
