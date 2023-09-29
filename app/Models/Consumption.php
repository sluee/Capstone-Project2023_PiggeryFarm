<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    protected $fillable = ['qtyConsumed', 'inventory_id', 'date_consumed'];


    public function inventory(){
        return $this->belongsTo(Inventory::class,'inventory_id');
    }
}
