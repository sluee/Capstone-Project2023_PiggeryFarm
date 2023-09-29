<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = ['cat_id', 'feed_id', 'qty', 'date_received', 'costPerStocks', 'discount', 'totalAmountAfterDiscount', 'sup_id'];

    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function feed(){
        return $this->belongsTo(Feed::class,'feed_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class,'cat_id');
    }
}
