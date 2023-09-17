<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weaning extends Model
{
    use HasFactory;
    protected $fillable = ['labor_id', 'no_of_pigs_weaned' , 'remarks'];
}
