<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labor extends Model
{
    use HasFactory;

    protected $fillable = ['breed_id', 'parity_no', 'exp_date_farrowing', 'no_pigs_born', 'no_pigs_alive','date_of_weaning', 'remarks'];

    // Labor.php
    public function breeding()
    {
        return $this->belongsTo(Breeding::class, 'breeding_id');
    }

    public function sow()
    {
        return $this->hasOneThrough(
            Sow::class,
            Breeding::class,
            'id',      // Foreign key on breedings table
            'id',      // Foreign key on sows table
            'breeding_id', // Local key on labor table
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
            'breeding_id', // Local key on labor table
            'boar_id'  // Local key on breedings table
        );
    }
}
