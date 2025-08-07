<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Check-up',
                'description' => 'General pet wellness check-up.',
                'price' => 300,
            ],
            [
                'name' => 'Deworming',
                'description' => 'Treatment for intestinal worms and parasites.',
                'price' => 250,
            ],
            [
                'name' => 'Home Service',
                'description' => 'Veterinary service at client’s location.',
                'price' => 800,
            ],
            [
                'name' => 'Laboratories',
                'description' => 'Blood tests, urinalysis, and other lab diagnostics.',
                'price' => 500,
            ],
            [
                'name' => 'Non-Surgical Procedures',
                'description' => 'Minor treatments not requiring anesthesia.',
                'price' => 600,
            ],
            [
                'name' => 'Surgical Procedures',
                'description' => 'Major surgeries requiring anesthesia and recovery.',
                'price' => 2500,
            ],
            [
                'name' => 'Therapies',
                'description' => 'Physical therapy or laser treatment for recovery.',
                'price' => 700,
            ],
            [
                'name' => 'Tick & Flea Preventive',
                'description' => 'Prevention or treatment of ticks and fleas.',
                'price' => 350,
            ],
            [
                'name' => 'Vaccinations',
                'description' => 'Core and optional pet vaccinations.',
                'price' => 450,
            ],
        ];

        foreach ($services as $index => $service) {
            DB::table('services')->insert([
                'id' => $index + 1,
                'name' => $service['name'],
                'description' => $service['description'],
                'price' => $service['price'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
    