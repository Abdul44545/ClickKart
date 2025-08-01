<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class paymentrequest extends Model
{
    //
        public function paymentinfo()
    {
        return $this->belongsTo(payment::class, 'submiter_follow_id');
    }
            public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
