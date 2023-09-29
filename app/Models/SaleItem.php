<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = ['sale_id', 'pen_no', 'pig_weight', 'rate'];

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function customers(){
        return $this->belongsTo(Customer::class, 'id');
    }


    public function getTotalAttribute()
    {
        // Ensure that pig_weight and rate are numeric before calculating total
        if (is_numeric($this->pig_weight) && is_numeric($this->rate)) {
            return $this->pig_weight * $this->rate;
        } else {
            // Handle cases where pig_weight or rate are not numeric
            return 0;
        }
    }

    public function calculateTotalAmount()
    {
        $totalAmount = $this->salesItems->sum(function ($item) {
            return $item->total ?? 0;
        });

        $this->total_amount = $totalAmount;
        $this->save();
    }

}
