<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'capacity',
        'price_per_day',
        'status',
        'image',
        'features',
        'specifications',
        'location'
    ];

    protected $casts = [
        'features' => 'array',
        'specifications' => 'array',
        'images' => 'array'
    ];

    /**
     * Get the image URL for the ship.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return 'https://placehold.co/800x400';
    }

    /**
     * Get the bookings for the ship.
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}