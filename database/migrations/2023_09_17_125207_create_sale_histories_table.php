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
        Schema::create('sale_histories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cust_id')->unsigned();
            $table->string('pen_no');
            $table->double('pig_weight');
            $table->double('rate');
            $table->double('total_amount');
            $table->double('payment');
            $table->double('balance');
            $table->timestamps();

            $table->foreign('cust_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_histories');
    }
};
