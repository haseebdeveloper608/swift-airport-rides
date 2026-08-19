<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'previous_driver',
        'vehicle_option',
        'pco_license',
        'vehicle_details',
        'status',
        'ip_address',
        'user_agent',
    ];

    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }
}
