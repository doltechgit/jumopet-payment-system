<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'product_id',
        'prev_quantity',
        'add_quantity',
        'new_quantity',
        'user_id'
        
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
