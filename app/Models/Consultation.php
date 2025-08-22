<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Consultation extends Model
{
     use HasFactory;

    protected $fillable = [
        'appointment_id',
        'user_id',
        'vet_id',
        'pet_id',
        'diagnosis',
        'treatment',
        'status',
    ];

    // Relationships
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vet()
    {
        return $this->belongsTo(User::class, 'vet_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
