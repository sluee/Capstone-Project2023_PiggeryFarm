<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getFormattedCreatedAtAttribute()
    {
        $from = Carbon::parse($this->attributes['payrollPeriodFrom']);
        $to = Carbon::parse($this->attributes['payrollPeriodTo']);

        return $from->format('F j, Y') . ' - ' . $to->format('F j, Y');
    }

    // public function getFormattedCreatedAtAttribute()
    // {
    //     return Carbon::parse($this->attributes['payrollPeriodFrom'])->format('Y-m-d H:i:s');
    //     return Carbon::parse($this->attributes['payrollPeriodTo'])->format('Y-m-d H:i:s');
    // }
}
