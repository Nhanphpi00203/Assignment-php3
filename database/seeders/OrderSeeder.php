<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::create([
            'name' => 'Tèo',
            'phone' => '123123123123',
            'address' => 'Cần Thơ',
            'email' => 'teo@gmail.com',
            'user_id' => 2,
        ]);
    }
}
