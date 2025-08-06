<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;

    // Specify which fields are mass assignable (fillable via create/update)
    protected $fillable = [
        'user_id',              // The ID of the user who made the appointment
        'pet_name',             // Name of the pet for the appointment
        'service',              // Type of service requested (e.g., grooming, checkup)
        'appointment_date',     // Date of the appointment
        'appointment_time',     // Time of the appointment
        'notes',                // Optional notes about the appointment
        'status'                // Status of the appointment (e.g., pending, confirmed)
    ];

    /**
     * Define the relationship between Appointment and User.
     * An appointment belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
