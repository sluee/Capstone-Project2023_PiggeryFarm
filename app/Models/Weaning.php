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
        return $this->belongsTo(Labor::class,'labor_id');
    }

    public function breeding()
    {
        return $this->belongsTo(Breeding::class,'breed_id');
    }
    public function sow()
    {
        return $this->hasOneThrough(
            Sow::class,
            Breeding::class,
            'id',      // local key on breedings table
            'id',      // local key on sows table
            'breed_id', // foreign key on labor table
            'sow_id'  // foreign key on breedings table
        );
    }

    public function boar()
    {
        return $this->hasOneThrough(
            Boar::class,
            Breeding::class,
            'id',      // Foreign key on breedings table
            'id',      // Foreign key on boars table
            'breed_id', // Local key on labor table
            'boar_id'  // Local key on breedings table
        );
    }
}
