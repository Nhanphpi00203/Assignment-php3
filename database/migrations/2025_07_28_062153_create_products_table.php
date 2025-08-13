<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	// public function up()
	// {
	// 	Schema::table('products', function (Blueprint $table) {
	// 		if (!Schema::hasColumn('products', 'title')) {
	// 			$table->string('title');
	// 		}
	// 		if (!Schema::hasColumn('products', 'slug')) {
	// 			$table->string('slug')->nullable();
	// 		}
	// 		if (!Schema::hasColumn('products', 'description')) {
	// 			$table->text('description')->nullable();
	// 		}
	// 		if (!Schema::hasColumn('products', 'content')) {
	// 			$table->text('content')->nullable();
	// 		}
	// 		if (!Schema::hasColumn('products', 'price')) {
	// 			$table->decimal('price', 15, 5);
	// 		}
	// 		if (!Schema::hasColumn('products', 'sale_price')) {
	// 			$table->decimal('sale_price', 15, 5)->nullable();
	// 		}
	// 		if (!Schema::hasColumn('products', 'thumbnail')) {
	// 			$table->string('thumbnail', 255)->nullable();
	// 		}
	// 		if (!Schema::hasColumn('products', 'status')) {
	// 			$table->enum('status', ['draft', 'published', 'scheduled'])->default('draft');
	// 		}
	// 		if (!Schema::hasColumn('products', 'category_id')) {
	// 			$table->unsignedBigInteger('category_id')->nullable();
	// 			$table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
	// 		}
	// 	});
	// }
	public function up(): void
	{
		Schema::create('products', function (Blueprint $table) {
			$table->id();
			$table->string('title');
			$table->string('slug')->nullable();
			$table->unsignedBigInteger('category_id');
			$table->string('thumbnail')->nullable();
			$table->text('description')->nullable();
			$table->text('content')->nullable();
			$table->decimal('price', 15, 2);
			$table->decimal('sale_price', 15, 2)->nullable();
			$table->timestamps();

			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::table('products', function (Blueprint $table) {
			$table->dropForeign(['category_id']);
			$table->dropColumn(['title', 'slug', 'description', 'content', 'price', 'sale_price', 'thumbnail', 'status', 'category_id']);
		});
	}
};
