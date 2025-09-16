<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{ /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
     protected $fillable = [
    'pet_code',
    'name',
    'species',
    'breed',
    'sex',
    'date_of_birth',
    'owner_id'
];

    protected $casts = [
        'date_of_birth' => 'date', // or 'datetime'
    ];

 public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function consultations()
    {
        return $this->hasMany(MedicalConsultation::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'pet_code', 'pet_code');
    }

    //


}
