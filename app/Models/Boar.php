<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boar extends Model
{
    use HasFactory;

    protected $fillable =['boar_no','breed', 'location', 'date_arrived'];

    public function breedings(){
        return $this->hasMany(Breeding::class , 'boar_id');
    }
}
