<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'NP6', 'price' => 120.00, 'category' => 'Medicine'],
            ['name' => 'Activim', 'price' => 1100.00, 'category' => 'Medicine'],
            ['name' => 'Septaplex', 'price' => 600.00, 'category' => 'Medicine'],
            ['name' => 'Healthy Liver', 'price' => 1200.00, 'category' => 'Supplement'],
            ['name' => 'Healthy Coat', 'price' => 1200.00, 'category' => 'Supplement'],
            ['name' => 'K9 Multivitamins', 'price' => 900.00, 'category' => 'Supplement'],
            ['name' => 'K9 Calcium', 'price' => 900.00, 'category' => 'Supplement'],
            ['name' => 'K9 Eye Drops', 'price' => 900.00, 'category' => 'Medicine'],
            ['name' => 'Ear Cleanse', 'price' => 950.00, 'category' => 'Care'],
            ['name' => 'Healthy Heart', 'price' => 1300.00, 'category' => 'Supplement'],
        ];

         foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'price' => $product['price'],
                'category' => $product['category'],
                'stock_quantity' => rand(10, 100),
                'description' => 'Veterinary product for pet health and wellness',
                'is_active' => true,
            ]);
    }
}
}