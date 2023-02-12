<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlinePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_payment', function (Blueprint $table) {
            $table->id();
            $table->Integer('order_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->double('amount');
            $table->text('address');
            $table->string('status');
            $table->string('transaction_id');
            $table->string('currency');            
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
        Schema::dropIfExists('online_payment');
    }
}
