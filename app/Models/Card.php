<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    protected $fillable = [
        'user_id',
        'product_id', 
        'quantity', 
        'total_price'
    ];

    public function product(){
        return $this->hasOne(Product::class, "id", "product_id");
    }

    public function user(){
        return $this->hasOne(User::class, "id", "user_id");
    }
}
