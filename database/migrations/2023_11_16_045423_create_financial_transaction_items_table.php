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
        Schema::create('financial_transaction_items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fin_id')->unsigned();
            $table->bigInteger('financial_transaction_id')->unsigned();
            $table->double('debit');
            $table->double('credit');
            $table->double('balance');
            $table->timestamps();
            $table->foreign('fin_id')->references('id')->on('financial_categories');
            $table->foreign('financial_transaction_id')->references('id')->on('financial_transactions');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transaction_items');
    }
};
