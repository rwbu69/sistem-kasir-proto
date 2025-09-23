<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'total_amount'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2'
    ];

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
