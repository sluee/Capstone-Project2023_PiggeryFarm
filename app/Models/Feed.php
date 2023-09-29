<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['cat_id', 'name', 'description'];


    public function category(){
        return $this->belongsTo(Category::class,'cat_id');
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'inv_id');
    }
}
