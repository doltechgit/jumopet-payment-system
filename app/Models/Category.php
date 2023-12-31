<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'refill',
        'user_id',
        'store_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

}
