<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'customer_name',
		'customer_email',
		'customer_phone',
		'customer_addr',
		'total_price',
		'status',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
