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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emp_id')->unsigned();
            $table->string('payrollPeriod');
            $table->double('daysWorked');
            $table->double('overtimeHours')->nullable();
            $table->double('overtimeAmount')->nullable();
            $table->double('cashAdvance')->nullable();
            $table->string('totalDeductions')->nullable();
            $table->string('netAmount');
            $table->timestamps();
            $table->foreign('emp_id')->references('id')->on('employees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
