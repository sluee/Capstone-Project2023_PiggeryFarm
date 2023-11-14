<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedsPurchase extends Model
{
    use HasFactory;

    protected $fillable = ['feed_id', 'qty', 'totalAmount', 'date'];

    public function feeds(){
        return $this->belongsTo(Feed::class ,'feed_id');
    }
}
