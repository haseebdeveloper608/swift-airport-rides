<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'stripe_session_id',
        'stripe_payment_intent_id',
        'customer_email',
        'first_name',
        'last_name',
        'customer_name',
        'customer_phone',
        'car_name',
        'pickup',
        'dropoff',
        'pickup_date',
        'pickup_time',
        'outbound_flight_number',
        'outbound_flight_time',
        'meet_greet_outbound_fee',
        'notes',
        'return_date',
        'return_time',
        'return_flight_number',
        'return_flight_time',
        'meet_greet_return_fee',
        'return_notes',
        'trip_type',
        'miles',
        'amount',
        'currency',
        'status',
    ];

    protected $casts = [
        'pickup_date' => 'date',
        'return_date' => 'date',
        'meet_greet_outbound_fee' => 'float',
        'meet_greet_return_fee' => 'float',
        'miles' => 'float',
        'amount' => 'float',
    ];
}
