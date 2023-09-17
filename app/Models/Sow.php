<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sow extends Model
{
    use HasFactory;
    protected $fillable =['sow_no', 'location', 'date_arrived'];

    public function breedings(){
        return $this->hasMany(Breeding::class , 'boar_id');
    }
}
