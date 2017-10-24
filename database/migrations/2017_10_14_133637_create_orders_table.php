<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');            
            $table->integer('user_id');
            $table->integer('branch_id');
            $table->integer('deliverer_id');
            $table->integer('otp');
            $table->string('details');
            $table->smallInteger('order_type');
            $table->string('shop_name');
            $table->string('shop_address');
            $table->string('delivery_address');
            $table->integer('est_amount');
            $table->integer('act_amount');
            $table->string('spl_instructions')->nullable();            
            $table->smallInteger('status');
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
        Schema::dropIfExists('orders');
    }
}
