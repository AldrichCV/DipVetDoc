<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedVet extends Model
{

     protected $table = 'assign_vet';


    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function vet()
    {
        return $this->belongsTo(Veterinarian::class, 'vet_id');
    }   
}
