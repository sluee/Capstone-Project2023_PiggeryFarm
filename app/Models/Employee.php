<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pos_id'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function position(){
        return $this->belongsTo(Position::class, 'pos_id');
    }
}
