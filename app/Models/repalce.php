<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class repalce extends Model
{
 
    //
        public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
        public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
           public function usermessage()
    {
        return $this->belongsTo(shippermessag::class, 'smessage_reply_id');
    }

}
