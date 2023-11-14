<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'description', 'price'];


    // public function supplier(){
    //     return $this->belongsTo(Supplier::class,'sup_id');
    // }


    public function feeds()
    {
        return $this->hasMany(Feed::class ,'cat_id');
    }

    public function consumption()
    {
        return $this->hasMany(Feed::class ,'cat_id');
    }
}
