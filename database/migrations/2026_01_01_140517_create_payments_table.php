<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id')->nullable();
            $table->dateTime('payment_date');
            $table->decimal('amount', 12, 2);
            $table->enum('method', ['cash', 'transfer', 'qris']);
            $table->enum('status', ['pending', 'paid'])->default('paid');
            $table->timestamps();

            // $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }
}
