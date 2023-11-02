<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashAdvance extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function employees(){
        return $this->belongsTo(Employee::class ,'emp_id');
    }

    public function deductions()
    {
        return $this->hasMany(Deductions::class, 'cashAdvanceId');
    }

}
