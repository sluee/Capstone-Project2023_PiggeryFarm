<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumption extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function feeds(){
        return $this->belongsTo(Feed::class ,'feed_id');
    }
    
}
