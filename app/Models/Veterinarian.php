<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Veterinarian extends Model
{
    protected $table = 'vet_profile';

       protected $fillable = [
        'user_id',
        'license_number',
        'clinic_name',
        'specialization',
        'is_active',
    ];

    // Cast active as boolean
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the vet profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
