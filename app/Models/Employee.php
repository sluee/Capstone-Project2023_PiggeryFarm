<?php

namespace App\Models;

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
    public function cashAdvance(){
        return $this->hasMany(CashAdvance::class , 'emp_id');
    }
}
