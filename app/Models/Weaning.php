<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weaning extends Model
{
    use HasFactory;
    protected $fillable = ['labor_id', 'no_of_pigs_weaned' , 'remarks'];

    public function labors()
    {
        return $this->belongsTo(Labor::class);
    }

    public function breeding()
    {
        return $this->belongsTo(Breeding::class);
    }

    public function sow()
    {
        return $this->belongsTo(Sow::class, 'sow_id', 'id');
    }

    public function boar()
    {
        return $this->belongsTo(Boar::class, 'boar_id', 'id');
    }
}
