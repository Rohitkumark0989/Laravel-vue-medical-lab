<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('p_name');
            $table->string('p_mobile')->nullable();
    	    $table->integer('p_age')->length(11);
            $table->string('p_gender')->nullable(11); 
	        $table->string('p_cnic')->nullable();
            $table->string('p_address')->nullable();
            $table->integer('p_subtotal')->length(11);
	        $table->integer('p_discount')->length(11);
	        $table->integer('p_total')->length(11);
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
        Schema::dropIfExists('patients');
    }
}
