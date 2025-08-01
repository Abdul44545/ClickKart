<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordercompelete extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

public function shipping()
{
    return $this->hasOne(Shipping::class, 'booking_key', 'booking_key');
}
}