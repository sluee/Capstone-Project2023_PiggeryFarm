<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =['name','address','phone'];

    // public function sale()
    // {
    //     return $this->hasMany(Sale::class,'cust_id');
    // }

    public function salesItems()
    {
        return $this->hasManyThrough(SaleItem::class, Sale::class, 'cust_id', 'sale_id');
    }
}
