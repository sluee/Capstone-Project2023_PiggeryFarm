<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable=['name', 'phone'];

    public function category(){
        return $this->hasMany(Category::class, 'sup_id');
    }

    public function inventory(){
        return $this->hasMany(Inventory::class, 'inv_id');
    }
}
