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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('feed_id')->unsigned();
            $table->integer('stock_in')->nullable();
            $table->integer('stock_out')->nullable()->default(0);
            $table->timestamps();
            $table->foreign('feed_id')->references('id')->on('feeds');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
