<?php

namespace App\Models; // Declares the namespace where this model belongs (App\Models)

use Illuminate\Database\Eloquent\Model; // Imports the base Eloquent Model class

// The Pet model represents the 'pets' table in the database
class Pet extends Model
{
    // Defines which attributes can be mass assigned using create() or update()
    // This helps protect against mass-assignment vulnerabilities
    protected $table = 'pet';
    protected $fillable = [
        'user_id', // Foreign key linking to the user who owns the pet
        'name',    // Name of the pet
        'species', // Species type (e.g., Dog, Cat)
        'breed',   // Breed of the pet (e.g., Golden Retriever, Persian)
        'age',     // Age of the pet (can be an integer or string depending on how you store it)
        'gender'   // Gender of the pet (e.g., Male, Female)
    ];
}
