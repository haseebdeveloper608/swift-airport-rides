<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'image',
        'destination',
        'price',
        'description',
        'base_price',
        'price_per_mile',
        'mileage_pricing'
    ];

    protected $casts = [
        'mileage_pricing' => 'array'
    ];

    /**
     * Get the image URL for the car
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // If it's already a full URL, return as is
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        // Otherwise, construct the storage URL
        return asset('/storage/' . $this->image);
    }
}
