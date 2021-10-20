<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;


    protected $casts = [
        'is_checkout'   => 'boolean'
    ];

    protected $fillable = ['name', 'description', 'quantity','sku','item_id','price','special_price','total_amount','is_checkout','status','user_id'];

}
