<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialTransactionItems extends Model
{
    use HasFactory;
    // protected $fillable =['fin_id', 'trans_id','debit', 'credit', 'balance'];
    protected $guarded =[];

   

    public function transaction(){
        return $this->belongsTo(FinancialTransaction::class ,'financial_transaction_id', 'id');
    }
}
