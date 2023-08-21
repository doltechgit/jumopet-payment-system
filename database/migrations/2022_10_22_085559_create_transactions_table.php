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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->foreignId('product_id');
            $table->foreignId('store_id');
            $table->foreignId('client_id');
            $table->foreignId('user_id');
            $table->float('quantity');
            $table->float('price');
            $table->float('discount');
            $table->float('paid');
            $table->float('balance');
            $table->string('pay_method');
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
        Schema::dropIfExists('transactions');
    }
};
