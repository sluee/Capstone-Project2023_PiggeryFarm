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
        Schema::create('weanings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('labor_id')->unsigned();
            $table->integer('no_of_pigs_weaned');
            $table->string('remarks')->nullable();
            $table->timestamps();

            $table->foreign('labor_id')->references('id')->on('labors');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weanings');
    }
};
