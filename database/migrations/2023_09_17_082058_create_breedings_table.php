<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('breedings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sow_id')->unsigned();
            $table->bigInteger('boar_id')->unsigned();
            $table->string('date_of_breed');
            $table->string('possible_reheat');
            $table->string('changeFeeds');
            $table->string('exp_date_of_farrowing');
            $table->string('remarks')->default("Waiting for results");
            $table->timestamps();

            $table->foreign('sow_id')->references('id')->on('sows');
            $table->foreign('boar_id')->references('id')->on('boars');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breedings');
    }
};
