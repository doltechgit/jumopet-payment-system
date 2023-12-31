<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentStock extends Model
{
    use HasFactory;

    protected $table = 'current_stocks';
    protected $fillable = [
        'quantity',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }
}
