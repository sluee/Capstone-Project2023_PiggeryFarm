<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;

    protected $fillable = ['breed_id', 'parity_no', 'actual_date_farrowing', 'no_pigs_born', 'no_pigs_alive','date_of_weaning'];

    // Labor.php
    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'breed_id');
    }

    public function sow()
    {
        return $this->hasOneThrough(
            Sow::class,
            Breeding::class,
            'id',      // Foreign key on breedings table
            'id',      // Foreign key on sows table
            'breed_id', // Local key on labor table
            'sow_id'  // Local key on breedings table
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

    public function weaning(){
        return $this->hasMany(Weaning::class , 'labor_id');
    }
}
