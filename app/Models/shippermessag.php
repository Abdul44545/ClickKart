<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shippermessag extends Model
{
    //
      protected $table = "shippermessages";

    protected $fillable = [
        'user_id',
        'product_id',
        'Order_id',
        'message',
    ];
}
