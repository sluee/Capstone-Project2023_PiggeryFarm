<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['sup_id', 'name', 'description'];


    public function supplier(){
        return $this->belongsTo(Supplier::class,'sup_id');
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'inv_id');
    }
}
