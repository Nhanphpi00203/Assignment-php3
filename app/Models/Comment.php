<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = ['content', 'status', 'product_id', 'user_id', 'created_at', 'updated_at'];

	// Quan hệ với User
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	// Quan hệ với Product
	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
