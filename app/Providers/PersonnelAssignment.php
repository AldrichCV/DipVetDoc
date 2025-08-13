<?php

namespace App\Services;

class PersonnelAssignment
{
    protected static array $serviceRoleMap = [
        'Vaccinations' => ['Veterinary Technician'],
        'Deworming' => ['Veterinary Technician'],
        'Tick & Flea Preventive' => ['Veterinary Technician'],
        'Laboratories' => ['Veterinary Technician'],
        'Surgical Procedures' => ['Veterinarian', 'Veterinary Technician', 'Senior Handler', 'Veterinary Nurse'],
        'Non-Surgical Procedures' => ['Veterinarian', 'Veterinary Technician'],
        'Check-up' => ['Veterinarian', 'Veterinary Technician'],
        'Therapies' => ['Veterinary Nurse'],
        'Home Service' => ['Junior Handler', 'Veterinary Technician'],
    ];

    public static function getRolesForService(string $service): array
    {
        return static::$serviceRoleMap[$service] ?? ['Utility Worker'];
    }
}
