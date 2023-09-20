<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breeding extends Model
{
    use HasFactory;

    protected $fillable = ['sow_id', 'date_of_breed', 'possible_reheat', 'changeFeeds', 'exp_date_of_farrowing', 'boar_id',];

    public function sow(){
        return $this->belongsTo(Sow::class,'sow_id');
    }
    public function boar(){
        return $this->belongsTo(Boar::class,'boar_id');
    }

    public function labors(){
        return $this->hasMany(Labor::class , 'breed_id');
    }
}
