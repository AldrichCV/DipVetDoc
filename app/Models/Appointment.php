<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Pet;
use App\Models\AssignedVet;

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
 public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_code', 'pet_code');
    } 

    public function assignedVet()
    {
        return $this->hasOne(AssignedVet::class, 'appointment_id');
    }
}
