<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaundryOrder;
use App\Models\Account;
use App\Models\LaundryType;
use Carbon\Carbon;

class LaundryOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get customer account (assuming first account is customer)
        $customer = Account::where('role', 'customer')->first();
        
        if (!$customer) {
            $this->command->error('No customer account found! Please create a customer account first.');
            return;
        }

        // Get laundry types
        $laundryTypes = LaundryType::all();
        
        if ($laundryTypes->isEmpty()) {
            $this->command->error('No laundry types found! Please create laundry types first.');
            return;
        }

        // Create 12 dummy orders with different statuses
        $orders = [
            [
                'weight_kg' => 4,
                'laundry_status' => 'process',
                'payment_status' => 'unpaid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(0),
                'pickup_date' => null,
                'notes' => 'Jangan sampai luntur',
            ],
            [
                'weight_kg' => 6,
                'laundry_status' => 'washed',
                'payment_status' => 'unpaid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(1),
                'pickup_date' => null,
                'notes' => 'Cepat yaa',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'process',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(2),
                'pickup_date' => null,
                'notes' => 'Hati-hati dengan pakaian putih',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'ready',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(3),
                'pickup_date' => Carbon::now()->addDays(1),
                'notes' => 'Segera diambil',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'washed',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(4),
                'pickup_date' => null,
                'notes' => null,
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'ready',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(5),
                'pickup_date' => Carbon::now()->addDays(2),
                'notes' => 'Pakai pewangi extra',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'washed',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(6),
                'pickup_date' => null,
                'notes' => 'Jangan dicampur dengan yang lain',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'washed',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(7),
                'pickup_date' => null,
                'notes' => null,
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'completed',
                'payment_status' => 'paid',
                'pickup_status' => 'picked_up',
                'order_date' => Carbon::now()->subDays(8),
                'pickup_date' => Carbon::now()->subDays(1),
                'notes' => 'Terima kasih',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'ready',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(9),
                'pickup_date' => Carbon::now()->addDays(1),
                'notes' => null,
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'washed',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(10),
                'pickup_date' => null,
                'notes' => 'Express please',
            ],
            [
                'weight_kg' => 4,
                'laundry_status' => 'ready',
                'payment_status' => 'paid',
                'pickup_status' => 'pending',
                'order_date' => Carbon::now()->subDays(11),
                'pickup_date' => Carbon::now()->addDays(1),
                'notes' => 'Rapikan dengan baik',
            ],
        ];

        foreach ($orders as $index => $orderData) {
            // Get random laundry type
            $laundryType = $laundryTypes->random();
            
            // Calculate price
            $pricePerKg = $laundryType->price_per_kg ?? 10000;
            $totalPrice = $pricePerKg * $orderData['weight_kg'];

            LaundryOrder::create([
                'account_id' => $customer->id,
                'laundry_type_id' => $laundryType->id,
                'voucher_id' => null,
                'order_date' => $orderData['order_date'],
                'pickup_date' => $orderData['pickup_date'],
                'weight_kg' => $orderData['weight_kg'],
                'price_per_kg' => $pricePerKg,
                'total_price' => $totalPrice,
                'notes' => $orderData['notes'],
                'payment_status' => $orderData['payment_status'],
                'laundry_status' => $orderData['laundry_status'],
                'pickup_status' => $orderData['pickup_status'],
                'created_at' => $orderData['order_date'],
                'updated_at' => $orderData['order_date'],
            ]);
        }

        $this->command->info('Successfully created 12 dummy laundry orders!');
    }
}
