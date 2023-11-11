<?php

namespace App\Models;

use App\Http\Controllers\PayrollItemController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pos_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'pos_id');
    }

    public function payroll(){
        return $this->hasMany(Payroll::class , 'emp_id');
    }
    public function payrollItem(){
        return $this->hasMany(PayrollItem::class , 'emp_id');
    }
    // public function cash_advance(){
    //     return $this->hasOne(CashAdvance::class ,'emp_id');
    // }

    public function cashAdvances()
    {
        return $this->hasMany(CashAdvance::class, 'emp_id');
    }

    public function advanceTotal()
    {
        return $this->hasOne(CashAdvanceTotals::class, 'emp_id');
    }
}
