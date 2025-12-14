<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LaundryType;

class LaundryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laundryTypes = [
            [
                'name' => 'Regular Laundry',
                'process_days' => 3,
                'price_per_kg' => 10000,
            ],
            [
                'name' => 'Fast Laundry',
                'process_days' => 1,
                'price_per_kg' => 15000,
            ],
            [
                'name' => 'Express Laundry',
                'process_days' => 0,
                'price_per_kg' => 20000,
            ],
            [
                'name' => 'Premium Laundry',
                'process_days' => 2,
                'price_per_kg' => 25000,
            ],
        ];

        foreach ($laundryTypes as $type) {
            LaundryType::create($type);
        }

        $this->command->info('Successfully created laundry types!');
    }
}
