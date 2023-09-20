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
        return $this->belongsTo(Labor::class, 'labor_id');
    }

    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'labor_id');
    }

    // public function sow()
    // {
    //     return $this->hasOne(Sow::class, 'id', 'id');
    // }
    // public function boar()
    // {
    //     return $this->hasOne(Boar::class, 'id', 'id');
    // }

    public function sow()
    {
        return $this->hasOneThrough(
            Sow::class,
            Breeding::class,
            Labor::class,
            'id',      // Foreign key on breedings table
            'id',
            'id' ,     // Foreign key on sows table
            'breed_id', // Local key on labor table
            'labor_id',
            'sow_id'  // Local key on breedings table
        );
    }

    // public function sow()
    // {
    //     return Sow::select('sows.*')
    //         ->join('breedings', 'sow.id', '=', 'breedings.sow_id')
    //         ->join('labors', 'breeding.labor_id', '=', 'labors.id')
    //         ->where('labors.id', $this->labor_id)
    //         ->first();
    // }

    public function boar()
    {
        return $this->hasOneThrough(
            Boar::class,
            Breeding::class,
            Labor::class,
            'id',      // Foreign key on breedings table
            'id',
            'id',     // Foreign key on boars table
            'breed_id', // Local key on labor table
            'labor_id',
            'boar_id'  // Local key on breedings table
        );
    }

}
