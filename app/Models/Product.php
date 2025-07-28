<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Product extends Model
{
   
    protected $fillable = [
        'name', 'description', 'Price', 'Stock', 'category', 'image1', 'image2', 'image3'
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'product_id'); // ✅ یہ درست ہے
    }
}
