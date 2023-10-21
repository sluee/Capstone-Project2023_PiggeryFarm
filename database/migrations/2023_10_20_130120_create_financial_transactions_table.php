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
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('fin_id')->unsigned();
            $table->string('description');
            $table->double('amount');
            $table->boolean('transactionType')->comment('1-credit , 0-debit');
            $table->timestamps();

            $table->foreign('fin_id')->references('id')->on('financial_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financial_transactions');
    }
};
