<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up()
	{
		Schema::create('order_items', function (Blueprint $table) {
			$table->id();

			$table->foreignId('order_id')
				->constrained('orders')  // liên kết khóa ngoại với bảng orders
				->onDelete('cascade');   // xóa order sẽ xóa luôn item

			$table->foreignId('product_id')
				->constrained('products') // liên kết khóa ngoại với bảng products
				->onDelete('cascade');

			$table->string('name');      // tên sản phẩm (lưu tạm lúc đặt hàng)
			$table->decimal('price', 15, 2); // giá sản phẩm tại thời điểm đặt
			$table->integer('quantity'); // số lượng

			$table->timestamps();        // created_at và updated_at
		});
	}

	public function down()
	{
		Schema::dropIfExists('order_items');
	}
};
