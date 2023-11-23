<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['cat_id', 'qty','sup_id',];

    public function categories(){
        return $this->belongsTo(Category::class ,'cat_id');
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class ,'sup_id');
    }

    public function purchase(){
        return $this->hasMany(FeedsPurchase::class, 'feed_id');
    }

    public function consumption(){
        return $this->hasMany(Consumption::class, 'feed_id');
    }

    public function inventory(){
        return $this->hasOne(Inventory::class, 'feed_id');
    }

}
