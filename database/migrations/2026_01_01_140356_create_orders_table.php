<?php

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
            $table->string('no_order')->unique();

            $table->integer('user_id')->nullable();
            $table->integer('laundry_type_id')->nullable();
            $table->integer('laundry_package_id')->nullable();

            $table->decimal('weight', 8, 2)->nullable();
            $table->integer('qty')->nullable();

            $table->date('date_in');
            $table->date('date_out')->nullable();

            $table->enum('status', [
                'antrian',
                'dikerjakan',
                'selesai_dikerjakan',
                'menunggu_pembayaran',
                'selesai'
            ])->default('antrian');

            $table->text('notes')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);

            $table->timestamps();

            // // Foreign Key
            // $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('laundry_type_id')->references('id')->on('laundry_types');
            // $table->foreign('laundry_package_id')->references('id')->on('laundry_packages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
