<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
