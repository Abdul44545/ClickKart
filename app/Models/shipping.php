<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
public function order()
{
    return $this->belongsTo(Ordercompelete::class, 'booking_key', 'booking_key');
}
}
