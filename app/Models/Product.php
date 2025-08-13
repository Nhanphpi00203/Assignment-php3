<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	// protected $fillable = [
	// 	'title',
	// 	'slug',
	// 	'description',
	// 	'price',
	// 	'content',
	// 	'sale_price',
	// 	'thumbnail',
	// 	'status',
	// ];
	protected $fillable = [
		'title',
		'slug',
		'category_id',
		'thumbnail',
		'description',
		'content',
		'price',
		'sale_price',
		'status',
	];
	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	// App\Models\Product.php
	public function comments()
	{
		return $this->hasMany(Comment::class, 'product_id');
	}

	protected $attributes = [];

	protected $dates = [];

	protected $casts = [];
}
