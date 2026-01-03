<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaundryPackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('duration_day');
            $table->decimal('price_per_kg', 12, 2)->nullable();
            $table->decimal('price_per_pcs', 12, 2)->nullable();
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
        Schema::drop('laundry_packages');
    }
}
