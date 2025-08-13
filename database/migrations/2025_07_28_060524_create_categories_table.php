<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('categories', function (Blueprint $table) {
			$table->id(); // Tương ứng với cột `id` (auto-increment)
			$table->string('name'); // Cột `name`, kiểu VARCHAR
			$table->string('slug')->unique(); // Cột `slug`, kiểu VARCHAR, unique
			$table->text('description')->nullable(); // Cột `description`, kiểu TEXT, cho phép NULL
			$table->boolean('status')->default(1); // Cột `status`, kiểu BOOLEAN, mặc định là 1
			$table->timestamps(); // Tạo cột `created_at` và `updated_at`
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('categories');
	}
};
