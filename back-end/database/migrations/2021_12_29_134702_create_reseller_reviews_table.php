<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResellerReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reseller_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->tinyInteger('vote');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('user_id_reviewed');
            $table->timestamps();

            $table->primary('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('user_id_reviewed')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reseller_reviews');
    }
}
