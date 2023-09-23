<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable= ['cust_id'];

    public function saleItem(){
        return $this->hasMany(SaleItem::class , 'sale_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'cust_id');
    }
}
