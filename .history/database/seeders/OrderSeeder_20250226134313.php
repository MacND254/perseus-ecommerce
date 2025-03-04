<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    public function run()
    {
        // Get some users and products from the database
        $users = User::all();
        $products = Product::all();

        if ($users->isEmpty() || $products->isEmpty()) {
            $this->command->info('No users or products found. Please seed users and products first.');
            return;
        }

        // Create 10 sample orders
        for ($i = 0; $i < 10; $i++) {
            $user = $users->random(); // Get a random user

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_amount' => 0, // Will be updated after adding order items
                'payment_status' => ['pending', 'paid', 'failed'][rand(0, 2)], // Random status
                'payment_method' => 'mpesa',
                'mpesa_code' => rand(100000, 999999), // Random Mpesa code
                'shipping_address' => '123 Test Street, Nairobi',
                'phone_number' => '07' . rand(10000000, 99999999),
                'status' => ['pending', 'processing', 'shipped', 'delivered'][rand(0, 3)]
            ]);

            $totalAmount = 0;

            // Add random products to the order
            $randomProducts = $products->random(rand(1, 5)); // Select 1 to 5 random products

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 3);
                $price = $product->price * $quantity;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);

                $totalAmount += $price;
            }

            // Update total amount in the order
            $order->update(['total_amount' => $totalAmount]);
        }
    }
}


