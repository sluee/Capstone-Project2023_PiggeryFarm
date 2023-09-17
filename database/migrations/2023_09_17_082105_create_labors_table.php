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
        Schema::create('labors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('breed_id')->unsigned();
            $table->integer('parity_no');
            $table->string('actual_date_farrowing');
            $table->integer('no_pigs_born');
            $table->integer('no_pigs_alive');
            $table->string('date_of_weaning');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('breed_id')->references('id')->on('breedings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labors');
    }
};
