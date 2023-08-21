<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'category_id',
        'dob',
        'trans_no',
        'store_id'

    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'client_id');
    }
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
    public function coupon()
    {
        return $this->hasOne(Coupon::class, 'client_id');
    }


}
