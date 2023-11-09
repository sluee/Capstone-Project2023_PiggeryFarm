<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $fillable =['position', 'rate'];

    public function employee(){
        return $this->hasOne(Position::class, 'pos_id');
    }
}
