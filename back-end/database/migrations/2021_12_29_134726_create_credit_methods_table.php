<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCreditMethodsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('credit_methods', function (Blueprint $table) {
            $table->id();
            $table->string('iban');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('credit_methods');
    }
}
