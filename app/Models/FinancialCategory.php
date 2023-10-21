<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCategory extends Model
{
    use HasFactory;

    protected $fillable =['particulars'];

    public function transaction(){
        return $this->hasMany(FinancialTransaction::class , 'fin_id');
    }
}
