<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advances extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function cashAdvance(){
        return $this->belongsTo(CashAdvance::class,'cashId');
    }
}
