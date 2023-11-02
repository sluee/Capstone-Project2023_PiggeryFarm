<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deductions extends Model
{
    use HasFactory;

    protected $guraded =[];

    public function employees()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
    public function cashAdvance()
    {
        return $this->belongsTo(CashAdvance::class, 'cashAdvanceId');
    }
}
