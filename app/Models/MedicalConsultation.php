<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pet;


class MedicalConsultation extends Model
{
    use HasFactory;

    protected $table = 'medical_consultations';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'pet_id',
        'owner_id',
        'vet_id',
        'body_weight',
        'respiratory_rate',
        'temperature',
        'complaint',
        'medication',
        'prescription',
        'status',
    ];

    /**
     * Relationships
     */

    // Pet involved in the consultation
    public function pet()
    {   
        return $this->belongsTo(Pet::class);
    }

    // // Owner of the pet (user)
    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'owner_id');
    // }

    // // Veterinarian handling the consultation
    // public function vet()
    // {
    //     return $this->belongsTo(User::class, 'vet_id');
    // }
    
}
