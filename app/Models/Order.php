<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'name',
        'product_id',
        'unit_price',
        'quantity',
        'price',
        'store_id'
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
