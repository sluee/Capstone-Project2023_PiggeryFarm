<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable= ['cust_id' , 'total_amount' ,'is_credit', 'balance' , 'remarks'];

    public function salesItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Define a relationship to represent the customer who made the sale
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
    }
}
