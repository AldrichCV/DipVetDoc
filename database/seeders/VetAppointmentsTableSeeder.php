<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class VetAppointmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        DB::table('vet_appointments')->insert([
            [
                'pet_id' => 1,
                'client_id' => 1,
                'vet_id' => 2,
                'appointment_date' => Carbon::today()->toDateString(),
                'appointment_time' => '10:00:00',
                'reason' => 'Vaccination',
                'notes' => 'Annual rabies vaccine.',
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'pet_id' => 2,
                'client_id' => 2,
                'vet_id' => 3,
                'appointment_date' => Carbon::tomorrow()->toDateString(),
                'appointment_time' => '14:30:00',
                'reason' => 'Check-up',
                'notes' => 'Limping on right leg.',
                'status' => 'scheduled',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
