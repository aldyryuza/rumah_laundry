<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaundryTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laundry_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 10)->unique(); 
            $table->string('name', 100);
            $table->boolean('is_weight_based')->default(true);
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
        Schema::drop('laundry_types');
    }
}
