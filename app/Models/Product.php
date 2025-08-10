<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'description',
        'price',
        'content',
        'sale_price',
        'thumbnail',
        'status',
    ];

    protected $attributes = [

    ];

    protected $dates = [

    ];

    protected $casts = [

    ];
}
