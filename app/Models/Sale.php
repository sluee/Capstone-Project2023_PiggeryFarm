<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable= ['cust_id'];

    public function salesItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Define a relationship to represent the customer who made the sale
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }
}
