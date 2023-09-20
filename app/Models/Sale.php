<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable =['cust_id', 'pig_weight','rate', 'pen_no'];

    public function customers(){
        return $this->belongsTo(Customer::class,'cust_id');
    }

    public function totalamount(){

    }
}
