<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function feeds(){
        return $this->belongsTo(Feed::class, 'feed_id');
    }

    public function getAvailableAttribute(){
        return $this->stock_out ? ($this->stock_in - $this->stock_out) : $this->stock_in;
    }
}
