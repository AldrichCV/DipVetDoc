<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
   protected $table = 'user_appointments';
  protected $fillable = [
    'pet_code',
    'client_id',
    'appointment_date',
    'appointment_time',
    'reason',
    'notes',
    'status',
    'vet_id'
];

}
