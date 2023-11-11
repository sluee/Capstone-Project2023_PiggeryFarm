<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    
    // Employee.php
    
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
    public function payrollItem()
    {
        return $this->hasMany(PayrollItem::class);
    }
}
