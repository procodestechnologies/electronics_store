<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_number',
        'address',
        'town',
        'phone',
        'email',
        'notes',
        'total',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItems::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
