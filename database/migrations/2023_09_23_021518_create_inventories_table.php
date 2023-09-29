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
            $table->integer('qty');
            $table->string('date_received');
            $table->double('costPerStocks');
            $table->double('discount');
            $table->double('totalAmountAfterDiscount');
            $table->bigInteger('feed_id')->unsigned();
            $table->bigInteger('cat_id')->unsigned();

            $table->timestamps();

            $table->foreign('feed_id')->references('id')->on('feeds');
            $table->foreign('cat_id')->references('id')->on('categories');
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
