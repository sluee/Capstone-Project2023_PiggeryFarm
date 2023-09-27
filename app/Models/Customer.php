<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable =['name','address','phone'];

    public function sales()
    {
        return $this->hasMany(Sale::class.'cust_id');
    }


    // public function salesItem(){
    //     return $this->hasOne(SaleItem::class);
    // }
}
