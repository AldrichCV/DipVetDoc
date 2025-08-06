<?php

namespace App\Models;

// Importing necessary traits and classes
// MustVerifyEmail is commented out, but you can use it if you require email verification
// HasFactory - for model factories (used in testing or seeding)
// Authenticatable - base class for authentication (login/logout, etc.)
// Notifiable - allows the model to receive notifications (e.g., email, SMS)
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * Include factory and notification traits.
     * HasFactory allows you to use `User::factory()` to create test or seed data.
     * Notifiable enables sending notifications to this user.
     */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable (fillable via forms or array).
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',       // The name of the user
        'email',      // The user's email
        'password',   // The user's password
    ];

    /**
     * The attributes that should be hidden during serialization (e.g., when returning user info in JSON).
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',        // Never expose passwords
        'remember_token',  // Token used by Laravel for "remember me" login
    ];

    /**
     * The attributes that should be cast to specific data types.
     * Useful for auto-converting data from DB to native PHP types.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime', // Cast email_verified_at as a Carbon datetime object
            'password' => 'hashed',            // Automatically hash the password when set
        ];
    }

    /**
     * Define one-to-many relationship: A user can have multiple appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Define one-to-many relationship: A user can have multiple pets.
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
