<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    protected $fillable = ['cat_id', 'name','description'];

    public function categories(){
        return $this->belongsTo(Category::class ,'cat_id');
    }
}
