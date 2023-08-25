<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'email',
        'contact',
        'admin'
    ];

    public function users(){
        return $this->hasMany(User::class, 'store_id');
    }

    public function clients()
    {
        return $this->hasMany(Client::class, 'store_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'store_id');
    }

    public function categories()
    {
        return $this->hasMany(Category::class, 'store_id');
    }

    public function transactions()
    {
       return $this->hasMany(Transaction::class, 'store_id');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'store_id');
    }
    public function current_stock()
    {
        return $this->hasOne(CurrentStock::class, 'store_id');
    }
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
}
