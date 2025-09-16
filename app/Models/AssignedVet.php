<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedVet extends Model
{

    protected $table = 'assigned_vet';
    
   public function vet()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
