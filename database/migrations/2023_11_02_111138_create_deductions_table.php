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
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emp_id')->unsigned();
            $table->bigInteger('cashAdvanceId')->unsigned()->nullable();
            $table->string('deductionType');
            $table->double('deductionAmount');
            $table->double('deductionDate');
            $table->timestamps();

            $table->foreign('emp_id')->references('id')->on('employees');
            $table->foreign('cashAdvanceId')->references('id')->on('cash_advances');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};
