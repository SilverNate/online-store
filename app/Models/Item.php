<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $casts = [
        'is_enable'   => 'boolean'
    ];


    protected $fillable = ['name', 'description', 'meta_description','sku','price','special_price','is_enable','quantity'];


}
